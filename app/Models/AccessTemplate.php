<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessTemplate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accesses()
    {
        return $this->hasMany(Access::class, 'access_template_id', 'id');
    }
    public function accessType()
    {
        return $this->belongsTo(AccessType::class, 'access_type_id', 'id');
    }
}
