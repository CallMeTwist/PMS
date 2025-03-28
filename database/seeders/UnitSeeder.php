<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Pediatrics'],
            ['name' => 'Neurology'],
            ['name' => 'Orthopaedics'],
            ['name' => 'Women\'s Health'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
