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
        Unit::insert([
            ['name' => 'Pediatric Unit'],
            ['name' => 'Neurology Unit'],
            ['name' => 'Orthopedic Unit'],
            ['name' => 'O&G Unit'],
        ]);
    }
}
