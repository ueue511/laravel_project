<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Comment;
use App\Book;
use Auth;

class CommentController extends Controller
{
    public function app(Request $request) {
        $comment_list = [];
        $comment_id = [];
        $comment_type = [];

        foreach($request[1] as $one) {
            //　コメントcomment_list comment_id comment_type
            array_push($comment_list, $one['data']['text']);
            array_push($comment_id, $one['id']);
            $comment_type = $one['type'];
        };
        
        $userdata = Auth::user();
        
        $bookid = $request[0]['bookid'];
        $bookdata = Book::find($bookid);
        
        // db保存
        $comment = new Comment;
        $comment->comment = $comment_list;
        $comment->editor_id = $comment_id;
        $comment->editor_type = $comment_type;
        
        $comment->save();

        $comment_savedata = $comment->find( $comment->id );

        $comment_savedata->users()->sync( $userdata );
        $comment_savedata->books()->sync( $bookdata );

        $bookone = Book::with('Comments.users')->find($bookid);
        
        return ($bookone);
    }
}