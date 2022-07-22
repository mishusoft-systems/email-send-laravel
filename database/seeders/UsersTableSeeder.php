<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();

        User::truncate();

        foreach (range(1, 50) as $i) {
            User::create(array(
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ));
        }

        User::create(array(
            'name' => 'admin',
            'email' => 'mrabir.ahamed@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'is_subscribe'=> true,
            'remember_token' => Str::random(10),
        ));
        User::create(array(
            'name' => 'user',
            'email' => 'sopnomon96@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'is_subscribe'=> true,
            'remember_token' => Str::random(10),
        ));
    }
}
