<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ward::insert([
            ['name' => 'Pediatric Ward'],
            ['name' => 'Medical Ward'],
            ['name' => 'Orthopedic Ward'],
            ['name' => 'Surgical Ward'],
            ['name' => 'Accident & Emergency'],
            ['name' => 'ICU'],
        ]);
    }
}
