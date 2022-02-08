<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tag;
use App\Book;

class SearchController extends Controller
{
    public function app( Request $request ) {

        $tagbook = $request->tagbook;
        $titlebook = $request->titlebook;
        
        // $book = Tag::find( $tagbook )->books;

        if( $tagbook && $titlebook ) {
            $book_search = Book::with([ 'comments', 'tags', 'petsusers' ])->whereHas('tags', function($query) use ($tagbook) {
                return $query->where( 'tags.id', $tagbook );
            })->where( 'item_name', 'like', '%'.$titlebook.'%' )->get();
            return $book_search;
            
        } elseif( $tagbook ) {
                $book_search = Tag::with( [ 'books.comments', 'books.petsusers' ] )->where( 'id', $tagbook )->get();
            $book = $book_search[ 0 ][ 'books' ];
            return $book;
            
        }  elseif( $titlebook ) {
            $book_search = Book::with([ 'comments','tags', 'petsusers' ])->where( 'item_name', 'like', '%'.$titlebook.'%' )->get();

            return $book_search;
        }
    }
}