<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ComputersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,50) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word . '-' . $faker->unique()->numberBetween(1, 100),
                'model' => $faker->randomElement(['Dell Optiplex 7090', 'HP EliteDesk 800 G6', 'Lenovo ThinkCentre M720']),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Windows 11 Pro', 'Linux Ubuntu']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'Intel Core i7-10700', 'AMD Ryzen 5 5600X']),
                'memory' => $faker->randomElement([8, 16, 32, 64]),
                'available' => $faker->boolean,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
