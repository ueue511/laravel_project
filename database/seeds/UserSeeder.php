<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create( 'ja_JP' );
        
        for($i = 0; $i < 3; $i++) {
            App\User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password'=> $faker->password(),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        };
    }
}