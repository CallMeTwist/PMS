<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function units()
    {
        return $this->belongsTo(Unit::class);
    }

    public function wards()
    {
        return $this->belongsTo(Ward::class);
    }
}
