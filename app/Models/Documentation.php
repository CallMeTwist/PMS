<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    public function patients()
    {
        return $this->belongsTo(Patient::class);
    }

    public function units()
    {
        return $this->belongsTo(Unit::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
