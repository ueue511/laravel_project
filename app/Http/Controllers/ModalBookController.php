<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Tag;
use Auth;

class ModalBookController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('admin');
    // }

    
    public function Show(Request $request) 
    {
        $books = Book::where( 'user_id', Auth::user()->id )->orderBy( 'created_at', 'asc' )->paginate(3);
        $tags = Tag::all();
        
        $published = ( $request->published );
        $target = array('年', '月', '日頃');
        $published_replace = str_replace($target, '-', $published);
        $published_end = rtrim($published_replace, '-');

        $request->session()->flash( 'message', '入力しました。tagを選択してください' );
        $request->session()->flash(
            '_old_input', [
                'item_name' => $request->item_name,
                'item_amount' => $request->item_amount,
                'item_img' => $request->item_img,
                'published' => $published_end,
            ]
        );
        $alert_type = 'alert-success';
        $book_one = null;

        return view( 'books' )->with([
            'books' => $books,
            'book_one' => $book_one,
            'alert' => $alert_type,
            'tags' => $tags,
        ]);
    }
}