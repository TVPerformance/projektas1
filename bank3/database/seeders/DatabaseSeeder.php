<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>'Zebras',
            'email' => 'zebras@gmail.com',
            'password' => Hash::make('123'),
        ]);
        DB::table('users')->insert([
            'name' =>'Bite',
            'email' => 'bite@gmail.com',
            'password' => Hash::make('123'),
        ]);

        $faker = Faker::create();

        foreach(range(0, 100) as $_) {
            DB::table('customers')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'account' => 'LT' .rand(0, 9) .rand(0, 9) .'-' .'3141'.'-' .'5' .rand(0, 9) .rand(0, 9) .rand(0, 9) .'-' .rand(0, 9) .rand(0, 9) .rand(0, 9) .rand(0, 9) .'-' .rand(0, 9) .rand(0, 9) .rand(0, 9) .rand(0, 9),
                'balance' => (rand(0, 99999999) / 100),
                'pers_id' => rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6).rand(3, 6),
               
            ]);
        }
    }
}
