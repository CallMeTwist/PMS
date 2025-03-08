<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_ward');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
