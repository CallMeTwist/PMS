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
            ['name' => 'Pediatric Unit', 'description' => 'Handles pediatric cases'],
            ['name' => 'Neurology Unit', 'description' => 'Handles neurological cases'],
            ['name' => 'Orthopedic Unit', 'description' => 'Handles orthopedic cases'],
            ['name' => 'O&G Unit', 'description' => 'Handles obstetrics and gynecology cases'],
        ]);
    }
}
