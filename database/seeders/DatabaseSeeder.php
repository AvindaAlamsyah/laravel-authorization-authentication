<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Permission as EnumsPermission;
use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permission = Permission::create(['name' => EnumsPermission::ALL_ACCESS->value]);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo($permission);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'administrator@example.com',
            'password' => Hash::make('password'),
            'type' => UserType::INTERNAL->value,
            'status' => UserStatus::ACTIVATED->value
        ]);

        $user->assignRole([$role->id]);
    }
}
