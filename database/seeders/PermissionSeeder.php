<?php

namespace Database\Seeders;

use App\Enums\Permission as EnumsPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role access
        Permission::updateOrCreate(
            ['name' => EnumsPermission::ALL_ACCESS->value],
            ['name' => EnumsPermission::ALL_ACCESS->value]
        );

        // Role access
        Permission::updateOrCreate(
            ['name' => EnumsPermission::ROLE_VIEW->value],
            ['name' => EnumsPermission::ROLE_VIEW->value]
        );
        Permission::updateOrCreate(
            ['name' => EnumsPermission::ROLE_CREATE->value],
            ['name' => EnumsPermission::ROLE_CREATE->value]
        );
        Permission::updateOrCreate(
            ['name' => EnumsPermission::ROLE_EDIT->value],
            ['name' => EnumsPermission::ROLE_EDIT->value]
        );
        Permission::updateOrCreate(
            ['name' => EnumsPermission::ROLE_DELETE->value],
            ['name' => EnumsPermission::ROLE_DELETE->value]
        );
    }
}
