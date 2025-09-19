<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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

        foreach (range(1, 10) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'status' => $faker->randomElement(['active', 'inactive', 'suspended']),
                'password' => Hash::make('12345678'),
                'email_verified_at' => $faker->boolean(80) ? now() : null,
                'last_login' => $faker->boolean(70) ? $faker->dateTimeThisYear() : null,
                'remember_token' => Str::random(10),
            ]);
        }
    }
}