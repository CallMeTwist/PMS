<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chief = Role::create(['name' => 'chief']);
        $physio = Role::create(['name' => 'physio']);
        $intern = Role::create(['name' => 'intern']);

        $permissions = [
            'create documentation',
            'view documentation',
            'edit documentation',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $chief->givePermissionTo(['create documentation', 'view documentation', 'edit documentation']);
        $physio->givePermissionTo(['create documentation', 'view documentation', 'edit documentation']);
        $intern->givePermissionTo(['create documentation', 'view documentation']);
    }
}
