<?php

namespace App\Console\Commands;

use App\Models\Asterisk;
use App\Models\Call;
use App\Models\CallStep;
use Illuminate\Console\Command;

class AsteriskImport extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'asterisk:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Exporting data from the asterisk table(cdr) to a normalized table';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	/*
	 * Последующий код не обременен читаемостью, потому что занимается нормализацией таблицы астериска
	 * по этой причине я постарался большую часть действий закоментировать
	 */
	public function handle() {
		// находим последний нормализованный звонок
		$last_call = Call::orderBy("id", "desc")->first();
		// если нет нормализованных звонков, начинаем с 0
		if($last_call) {
			$last_call_id = $last_call->raw_call_id;
		} else {
			$last_call_id = "";
		}
		// берем записи не старше месяца
		$last_month = now()->subMonth();
		$items = Asterisk::whereColumn("linkedid", "uniqueid")
			->where("calldate", ">", $last_month)
			->where("linkedid", ">", $last_call_id);
		$count = $items->count();
		$this->line("Create rows in table Call according to table CDR");

		//готовим прогресбар
		$bar = $this->output->createProgressBar($count);
		$bar->start();

		//Вставляем черновые данные о звонке
		$items->lazy()
			->each(function($row) use ($bar) {
				$call               = new Call();
				$call->raw_call_id  = $row->linkedid;
				$call->caller_phone = $row->src;
				$call->called_phone = $row->dst;
				$call->dialed_phone = $row->did;
				$call->is_out       = !preg_match("/\d{5,}/", $row->src);
				$call->status       = 1;
				$call->duration     = $row->billsec;
				$call->expectation  = $row->duration - $row->billsec;
				$call->date         = $row->calldate;
				$call->record_file  = $row->recordingfile;
				$call->save();

				$bar->advance();
			});
		$bar->finish();
		$this->newLine(2);

		$this->line("Editing rows in table Call and create steps for call according to table CDR");
		$last_call_step = CallStep::orderBy("id", "desc")->first();
		$last_call_step = $last_call_step ? $last_call_step->call_id : 0;
		$calls = Call::where("id",">", $last_call_step);
		$bar = $this->output->createProgressBar($calls->count());
		$bar->start();

		$calls->chunk(500, function($items) use ($bar) {
			$ids    = $items->pluck("raw_call_id");
			$groups = Asterisk::whereIn("linkedid", $ids)->orderBy("calldate")
				->get()
				->groupBy("linkedid");
			foreach($groups as $key => $group_items) {

				/*
				 * подготавливаем данные: ищем главный элемент звонка,
				 * группируем элементы по дате чтобы разбить на этапы,
				 * и инициализируем счетчик этапов
				 */
				$main_item               = $items->firstWhere("raw_call_id", $key);
				$group_items             = $group_items->sortBy("calldate");
				$items_group_by_calldate = $group_items->groupBy("calldate");
				$step_count              = 1;

				// патчим звонок зная некоторые детали о его ходе
				$main_item = $this->patchCall($main_item, $group_items);

				$failed_transfer = false;
				foreach($items_group_by_calldate as $items_for_step) {
					//записываем данные только в случае если шагов больше одого, ради экономии памяти
					if( $group_items->count() > 1 || $items_for_step->count() > 1) {
						foreach($items_for_step as $item_for_step) {
							$transfer_data = json_decode($item_for_step->trdata);

							$is_show = $this->getIsShow($items_for_step, $item_for_step);
							$create_data = [
								"step"        => $step_count,
								"call_id"     => $main_item->id,
								"duration"    => $item_for_step->duration,
								"expectation" => $item_for_step->duration - $item_for_step->billsec,
								"number"      => $item_for_step->dst,
								"status"      => $item_for_step->trdata ? "NO ANSWER" :  $item_for_step->disposition,
								"date"        => $item_for_step->calldate,
								"is_show"     => $is_show
							];
							CallStep::create($create_data);
							if($item_for_step->trdata){
								if($transfer_data){
									if(preg_match("/\d{1,}/", $item_for_step->dst)){
										$step_count++;
										$create_data["step"] = $step_count;
										$create_data["expectation"] = 0;
										$create_data["duration"] = 0;
										$create_data["status"] = "ANSWERED";
										$create_data["number"] = $transfer_data->owner;
										CallStep::create($create_data);
									} else {
										$failed_transfer = $transfer_data;
									}
								}
							}
						}

					}
					$step_count++;
				}
				if($failed_transfer){
					$step_count++;
					$create_data["step"] = $step_count;
					$create_data["is_show"] = 1;
					$create_data["expectation"] = 0;
					$create_data["duration"] = 0;
					$create_data["status"] = "NO ANSWER";
					$create_data["number"] = $failed_transfer->tran;
					CallStep::create($create_data);
					$create_data["number"] = $failed_transfer->owner;
					CallStep::create($create_data);
				}
				$bar->advance();
			}
		});

		$bar->finish();
		return 0;
	}

	public function patchCall($main_item, $group_items){
		$answered_items = $group_items->where("disposition", "ANSWERED");
		$status         = 2;        //по умолчанию звонок считается как пропущенный
		//если есть запись о том что кто-то ответил с реальным номером, то ставим как успешный
		foreach($answered_items as $item) {
			if(preg_match("/\d{1,}/", $item->dst)) {
				$status = 1;
				break;
			}
		}
		//устанавливаем статус звонка
		$main_item->status = $status;

		$answered                = $answered_items->last();
		if(!$main_item->is_out){
			$main_item->called_phone = $answered ? $answered->dst : "";
		}

		$main_item->save();
		return $main_item;
	}

	public function getIsShow($items_for_step, $item_for_step){
		if($item_for_step->disposition == "ANSWERED"){
			if(preg_match("/\d{1,}/", $item_for_step->dst)){
				if($item_for_step->lastapp == "Transferred Call"){
					//нужно выделить спровождаемый перевод
					return 2;
				}

				return true;
			}
		}
		return false;
	}
}
