<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accessTemplates()
    {
        return $this->hasMany(AccessTemplate::class, 'type_id', 'id');
    }
}
