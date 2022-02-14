<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Comment;
use App\Book;

class BooklistController extends Controller
{
    public function index() 
    {
        return Book::limit(5)->get();
    }

    public function NewComments() 
    {
        $books = Comment::with('Books')->orderBy('created_at', 'desc')->limit(5)->get();

        return $books;
    }
}