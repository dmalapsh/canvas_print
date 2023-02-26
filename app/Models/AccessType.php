<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessType extends Model
{
    use HasFactory;

    public function access_template()
    {
        return $this->hasMany(AccessTemplate::class, 'type_id', 'id');
    }
}
