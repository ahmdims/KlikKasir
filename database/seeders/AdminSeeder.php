<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'superadmin', 'guard_name' => 'web'],
            ['id' => Str::uuid()]
        );

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'status' => 'active',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'last_login' => now(),
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole($role);
    }
}