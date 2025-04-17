<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('wards')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $wards = [
            ['name' => 'Pediatric Ward', 'description' => 'For Pediatric cases'],
            ['name' => 'Medical Ward', 'description' => 'For Medical cases'],
            ['name' => 'Orthopedic Ward', 'description' => 'For Orthopedic cases'],
            ['name' => 'Surgical Ward', 'description' => 'For Surgeries'],
            ['name' => 'Accident & Emergency', 'description' => 'For Emergency cases'],
            ['name' => 'ICU', 'description' => 'For Critical cases'],
        ];

        DB::table('wards')->insert($wards);
    }
}
