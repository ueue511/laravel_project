<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest;

use App\Book;
use Auth;

class StackedWiteBooks extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // home周辺のコントロール
    public function BookShowHome()
    {
        $goodid_arr = [];
        $bookmarkid_arr = [];
        $goodid = Auth::user()->petsbooks;
        $bookmarkid = Auth::user()->goodsbooks;
        foreach ($goodid as $value) {
            array_push($goodid_arr, $value->id);
        }
        
        foreach ($bookmarkid as $value) {
            array_push($bookmarkid_arr, $value->id);
        }

        
        return view('Stack_home')->with([
            'goodid' => $goodid_arr,
            'bookmarkid' => $bookmarkid_arr
        ]);
    }

    // 詳細ページ
    public function BookDetail(Request $request, $book_id )
    {
        $bookone = Book::with('Comments.users')->find($book_id);
        return view('Stack_home')->with([
            'books' => $bookone,
        ]);
    }
}