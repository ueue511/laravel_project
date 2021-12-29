<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 100; $i++) {
            App\Comment::create([
                'comment' => $faker->realText(100),
                'created_at' => $faker->dateTime('now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        };
    }
}