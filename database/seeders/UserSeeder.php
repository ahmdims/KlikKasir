<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'phone' => $faker->phoneNumber,
            'status' => 'active',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'last_login' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach (range(1, 10) as $i) {
            DB::table('users')->insert([
                'id' => Str::uuid(),
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'status' => $faker->randomElement(['active', 'inactive', 'suspended']),
                'password' => Hash::make('12345678'),
                'email_verified_at' => $faker->boolean(80) ? now() : null,
                'last_login' => $faker->boolean(70) ? $faker->dateTimeThisYear() : null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
