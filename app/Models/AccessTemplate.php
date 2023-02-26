<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessTemplate extends Model
{
    use HasFactory;

    public function accesses()
    {
        return $this->hasMany(Access::class, 'template_id', 'id');
    }
    public function access_type()
    {
        return $this->belongsTo(AccessType::class, 'type_id', 'id');
    }
}
