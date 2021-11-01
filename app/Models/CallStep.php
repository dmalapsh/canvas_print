<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallStep extends Model
{
	protected $guarded    = [];
	public $timestamps = false;

	public function call() {
		return $this->belongsTo(Call::class, 'call_id', 'id');
	}
}
