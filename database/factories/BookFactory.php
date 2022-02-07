<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'item_name' => $faker->word(),
        'user_id' => $faker->numberBetween(1, 10),
        'item_amount' => $faker->numberBetween(100, 5000),
        // 'item_img' => $faker->image("./public/update", 300, 300, 'cats', false), //ローカル用
        'item_img' => $faker->url(), // テスト用
        'published' => $faker->dateTime('now'),
        'created_at' => $faker->dateTime('now'),
        'updated_at' => $faker->dateTime('now'),
        'public_id' => $faker->uuid(),
        'url' => $faker->url()
    ];
});