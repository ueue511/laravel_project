<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class GoodsController extends Controller
{
    public function GoodUp(Request $request) 
    {
        $userdata = Auth::user();
        $book_id = $request->book_id;

        $userdata->GoodsBooks()->attach($book_id);
        return back();
    }

    public function GoodDown(Request $request) 
    {
        $userdata = Auth::user();
        $book_id = $request->book_id;

        $userdata->GoodsBooks()->detach($book_id);
        return back();
    }
}