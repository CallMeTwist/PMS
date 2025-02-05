<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function units()
    {
        return $this->belongsTo(Unit::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
