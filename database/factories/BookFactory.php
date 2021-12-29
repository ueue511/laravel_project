<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'item_name' => $faker->word(),
        'user_id' => $faker->numberBetween(1, 10),
        'item_amount' => $faker->numberBetween(100, 5000),
        'item_img' => $faker->image("./public/update", 300, 300, 'cats', false),
        // 'comment' => $faker->realText(100),
        'published' => $faker->dateTime('now'),
        // 'tabu' => $faker->randomElement($bookstab),
        'created_at' => $faker->dateTime('now'),
        'updated_at' => $faker->dateTime('now'),
    ];
});