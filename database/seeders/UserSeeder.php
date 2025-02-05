<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chief = User::factory()->create([
            'name' => 'Chief Physio',
            'email' => 'chief@example.com',
            'password' => Hash::make('password'),
            'role' => 'chief',
            'unit_id' => 1,
        ]);
        $chief->assignRole('chief');

        $physio = User::factory()->create([
            'name' => 'Principal Physio',
            'email' => 'physio@example.com',
            'password' => Hash::make('password'),
            'unit_id' => 2,
        ]);
        $physio->assignRole('physio');

        $intern = User::factory()->create([
            'name' => 'Intern Physio',
            'email' => 'intern@example.com',
            'password' => Hash::make('password'),
            'role' => 'intern',
            'unit_id' => 3,
        ]);
        $intern->assignRole('intern');
    }
}
