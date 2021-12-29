<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Book;
use App\Comment;

class CommentablesSeeder extends Seeder
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
            $set_comment_id = Comment::select('id')->orderbyRaw('RAND()')->first()->id;
            $type_list = [
                'App\Book',
                'App\User'
            ];

            // クエリビルダを利用し、上記のモデルから取得した値が、現在までの複合主キーと重複するかを確認
            $post_comment = DB::table('commentables')->where([
                ['comment_id', '=', $set_comment_id],
                ['commentables_id', '=', $set_user_id],
                ['commentables_type', '=',$type_list[1] ]
            ])->get();

            // 上記のクエリビルダで取得したコレクションが空の場合、外部キーに上記のモデルから取得した値をセット
            if ($post_comment->isEmpty()) {
                DB::table('commentables')->insert(
                    [
                        'comment_id' => $set_comment_id,
                        'commentables_id' => $set_user_id,
                        'commentables_type' => $type_list[1]
                    ]
                );
                DB::table('commentables')->insert(
                    [
                        'comment_id' => $set_comment_id,
                        'commentables_id' => $set_book_id,
                        'commentables_type' => $type_list[0]
                    ]
                );
            } else {
                $i--;
            };
        };
    }
}