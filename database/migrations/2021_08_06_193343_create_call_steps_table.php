<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_steps', function (Blueprint $table) {
            $table->id();
	        $table->integer("step");
	        $table->integer("call_id");
	        $table->integer("duration");
	        $table->integer("expectation");
            $table->string("number");
            $table->string("status");
            $table->boolean("is_show");
            $table->dateTime("date");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_steps');
    }
}
