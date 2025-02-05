<?php

namespace Database\Seeders;

use App\Models\Documentation;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::all()->each(function ($patient) {
            Documentation::factory(3)->create([
                'patient_id' => $patient->id,
                'unit_id' => $patient->unit_id,
                'user_id' => User::where('unit_id', $patient->unit_id)->inRandomOrder()->first()->id,
            ]);
        });
    }
}
