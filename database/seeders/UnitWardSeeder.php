<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitWardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit1 = Unit::create(['name' => 'Orthopedic']);
        $unit2 = Unit::create(['name' => 'Neurology']);

        $ward1 = Ward::create(['name' => 'A&E']);
        $ward2 = Ward::create(['name' => 'Post-Surgical Ward']);

        $unit1->wards()->attach([$ward1->id, $ward2->id]);
        $unit2->wards()->attach([$ward1->id]);
    }
}
