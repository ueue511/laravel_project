<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TagTableSeeder::class,
            BooksTableSeeder::class,
            BookUserGoodSeeder::class,
            BookUserPetSeeder::class,
            CommentsTableSeeder::class,
            // CommentTableSeeder::class,
        ]);
    }
}