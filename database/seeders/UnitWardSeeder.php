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
        $unitWardData = [
            // Pedo for Pedo
            ['unit_id' => 1, 'ward_id' => 1],

            // Ndi Neuro ga na fu ndi Medical Ward, A&E na Surgical Ward
            ['unit_id' => 2, 'ward_id' => 2],
            ['unit_id' => 2, 'ward_id' => 5],
            ['unit_id' => 2, 'ward_id' => 4],

            // Ndi Orthopedic ga na fu ndi Surgical Ward, Orthopedic Ward,  na A&E
            ['unit_id' => 3, 'ward_id' => 4],
            ['unit_id' => 3, 'ward_id' => 3],
            ['unit_id' => 3, 'ward_id' => 5],

            // Ndị vagina ga na-ahụ ụfọdụ ndị nọ na Medical Ward
            ['unit_id' => 4, 'ward_id' => 2],
        ];

        DB::table('unit_ward')->insert($unitWardData);
    }
}
