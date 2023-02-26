<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function access_template()
    {
        return $this->belongsTo(AccessTemplate::class, 'template_id', 'id');
    }
}
