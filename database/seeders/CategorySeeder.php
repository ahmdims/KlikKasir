<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $tenants = DB::table('tenants')->get();

        foreach ($tenants as $tenant) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('categories')->insert([
                    'id' => Str::uuid(),
                    'tenant_id' => $tenant->id,
                    'name' => ucfirst($faker->unique()->word),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
