<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookstab = [
            '総気',
            '哲学',
            '歴史',
            '社会科学',
            '自然科学',
            '技術',
            '産業',
            '芸術',
            '言語',
            '文学'
        ];

        $faker = Faker\Factory::create('ja_JP');

        foreach ($bookstab as $tab) {
            App\Tag::create([
                'tab' => $tab,
                'created_at' => $faker->dateTime('now'),
                'updated_at' => $faker->dateTime('now'),
            ]);
        };
    }
}