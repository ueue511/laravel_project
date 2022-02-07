<?php

use Illuminate\Database\Seeder;
use App\Tag;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();

        // factoryを利用
        factory(App\Book::class, 50)
        ->create()
        ->each(function ( App\Book $book ) use ( $tags ){
                // 1〜9までの数値をランダムで取得
                $ran = rand(1, 9);

                // 中間テーブルに紐付け
                $book->tags()->attach(
                    //tagsテーブルからランダムで１〜９個のインスタンスを紐付ける
                    $tags->random($ran)->pluck( 'id' )->toArray(),
                );
            });
    }
}