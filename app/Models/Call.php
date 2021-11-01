<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
	protected $guarded    = [];
	public $timestamps = false;

	public function call_steps() {
		return $this->hasMany(CallStep::class, 'call_id')->orderBy("date");
	}

	public function call_steps_show() {
		return $this->hasMany(CallStep::class, 'call_id')->where("is_show",">", 0)->orderBy("date");
	}
}
