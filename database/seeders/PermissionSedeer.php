<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create role','guard_name' => 'web']);
        Permission::create(['name' => 'read role','guard_name' => 'web']);
        Permission::create(['name' => 'update role','guard_name' => 'web']);
        Permission::create(['name' => 'delete role','guard_name' => 'web']);

    }
}
