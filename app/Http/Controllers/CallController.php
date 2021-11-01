<?php

namespace App\Http\Controllers;

use App\Helpers\ParseHelper;
use App\Models\Asterisk;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
{
	public function index(Request $request) {
		$items = Call::limit(500)->orderBy("date", "desc");
		if($request->str && $request->items && count($request->items)){
			$request->str = preg_replace("/\s+/","", $request->str);
			$items_ = [];
			foreach($request->items as $key => $item){
				$items_[$key+1] = $item;
			}
			$items->where(ParseHelper::makeQueryBuilder($items_, $request->str));
		}
		$items = $items->with("call_steps_show", "call_steps")->get();
		return response()->json($items);
	}

	public function sink(Request $request){
		if(Auth::check()){
			return Artisan::call("asterisk:import");
		} else {
			if($request->token == env("TOKEN_REFRESH")){
				dd("ok");
			} else {
				dd($request->token);
			}
		}
	}
}
