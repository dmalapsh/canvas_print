<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asterisk extends Model
{
	protected $connection = "asterisk";
	protected $table      = "cdr";
}
