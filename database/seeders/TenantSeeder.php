<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            DB::table('tenants')->insert([
                'id' => Str::uuid(),
                'user_id' => 1,
                'name' => $faker->company,
                'slug' => Str::slug($faker->unique()->company),
                'logo' => null,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'is_active' => $faker->boolean(90),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
