<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;
use App\Models\Ward;
use App\Models\Documentation;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($patient) {
            $patient->patient_number = self::generateNextPatientNumber();
        });
    }

    protected static function generateNextPatientNumber()
    {
        // Find the highest current patient number
        $latestPatient = self::orderBy('created_at', 'desc')->whereNotNull('patient_number')->first();

        if (!$latestPatient) {
            $number = 1;
        } else {
            // Extract the number part from the latest patient_number
            $lastNumber = (int) str_replace('PT-', '', $latestPatient->patient_number);
            $number = $lastNumber + 1;
        }

        return 'PT-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }
}
