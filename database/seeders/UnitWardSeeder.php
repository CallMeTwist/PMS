<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitWardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit_ward')->truncate();

        $unitWardData = [
            ['unit_id' => 1, 'ward_id' => 1], // Pediatric Unit -> Pediatric Ward

            ['unit_id' => 2, 'ward_id' => 2], // Neurology -> Medical
            ['unit_id' => 2, 'ward_id' => 4], // Neurology -> Surgical
            ['unit_id' => 2, 'ward_id' => 5], // Neurology -> A&E

            ['unit_id' => 3, 'ward_id' => 3], // Ortho -> Ortho Ward
            ['unit_id' => 3, 'ward_id' => 4], // Ortho -> Surgical
            ['unit_id' => 3, 'ward_id' => 5], // Ortho -> A&E
            ['unit_id' => 3, 'ward_id' => 6], // Ortho -> A&E

            ['unit_id' => 4, 'ward_id' => 2], // O&G -> Medical (depending)
        ];

        DB::table('unit_ward')->insert($unitWardData);
    }
}
