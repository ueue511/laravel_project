<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Book;

class BookUserGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            // userテーブルとbookテーブルのidカラムをランダムに並び替えて先頭を取得
            $set_user_id = User::select('id')->orderbyRaw('RAND()')->first()->id;
            $set_book_id = Book::select('id')->orderbyRaw('RAND()')->first()->id;

            // クエリビルダを利用し、上記のモデルから取得した値が、現在までの複合主キーと重複するかを確認
            $post_comment = DB::table('book_user_good')->where([
                ['user_id', '=', $set_user_id],
                ['book_id', '=', $set_book_id]
            ])->get();

            // 上記のクエリビルダで取得したコレクションが空の場合、外部キーに上記のモデルから取得した値をセット
            if ($post_comment->isEmpty()) {
                DB::table('book_user_good')->insert(
                    [
                        'user_id' => $set_user_id,
                        'book_id' => $set_book_id,
                    ]
                );
            } else {
                $i--;
            };
        }
    }
}