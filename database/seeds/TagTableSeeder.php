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
            '単行本',
            '文庫',
            '新書',
            '全集・双書',
            'ムック・その他',
            '事・辞典',
            '図鑑',
            '絵本',
            '磁性媒体など',
            'コミック'
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