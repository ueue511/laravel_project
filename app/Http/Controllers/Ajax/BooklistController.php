<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BooklistController extends Controller
{
    public function index() {
        return \App\Book::all();
    }
}