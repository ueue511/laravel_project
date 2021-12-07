<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class PetController extends Controller
{
    public function PetUp(Request $request) 
    {
        $userdata = Auth::user();
        $book_id = $request->book_id;

        $userdata->PetsBooks()->attach($book_id);
        return back();
    }

    public function PetDown(Request $request)
    {
        $userdata = Auth::user();
        $book_id = $request->book_id;

        $userdata->PetsBooks()->detach($book_id);
        return back();
    }
}