<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();

            //linkedid
            $table->string("raw_call_id");

            //src
            $table->string("caller_phone")->nullable();

            //если со внешки то любой dst, если во внешку, то последний по времени dst у которого статус answered
            $table->string("called_phone")->nullable();

            //did
            $table->string("dialed_phone")->nullable();

            //если src больше чем может быть на внутреннем
            $table->boolean("is_out");

            //если и dst и src - внутренние
            $table->boolean("is_local");

            /*
             * 1 - Отвечен - если есть answered у которого dst содержит в себе число
             * 2 - иначе
             */
            $table->tinyInteger("status");

            //duration самого старого
            $table->integer("duration");

            //duration самого старого вычесть его billsec
            $table->integer("expectation");

            //самый маленький calldate
            $table->dateTime("date");

            //recordingfile
            $table->string("record_file");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calls');
    }
}
