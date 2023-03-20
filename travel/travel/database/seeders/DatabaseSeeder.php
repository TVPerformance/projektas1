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
            'name' => 'Zebras',
            'email' => 'zebras@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Liutas',
            'email' => 'liutas@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'manager',
        ]);

        DB::table('users')->insert([
            'name' => 'Kiskis',
            'email' => 'kiskis@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'customer',
        ]);

        $faker = Faker::create();

        foreach(range(1, 33) as $_) {
            DB::table('countries')->insert([
                'title' => $faker->country(),                           
                'start' => $faker->dateTimeThisMonth(),
                'end' => $faker->dateTimeThisMonth(),
            ]);
        }
            
        foreach(range(1, 66) as $_) {
            DB::table('hotels')->insert([
                'title' => $faker->lastName(),
                'price' => rand(225, 1666),
                'picture' => null,                      
                'duration' => rand(7, 16),
                'country_id' => rand(1, 30),
                'desc' => $faker->realText(400, 5),
            ]);
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
