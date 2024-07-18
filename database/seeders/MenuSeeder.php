<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i <= 15; $i++) {
            $name = $faker->sentence(2); 
            $price = $faker->numberBetween(1000, 10000); 
            DB::table('menus')->insert([
                'name' => $name,
                'price' => $price,
            ]);
        }
    }
}
