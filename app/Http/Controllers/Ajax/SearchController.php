<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Book;

use Auth;

class SearchController extends Controller
{
    public function app( Request $request ) {

        $tagbook = $request->tagbook;
        $titlebook = $request->titlebook;
        $like = $request->like;
        $good = $request->good;
        $user = Auth::user()->id;
        
        // タイトルとタグでの検索
        if( $tagbook && $titlebook ) 
        {
            if ( $like === false && $good === false )
            { 
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereTitle( $titlebook )
                    ->get();
            } elseif ( $like === true && $good === false ) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereTitle( $titlebook )
                    ->WhereHasLike( $user )
                    ->get();
            } elseif ( $like === false && $good === true ) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereTitle( $titlebook )
                    ->WhereHasGood( $user )
                    ->get();
            } elseif ( $like === true && $good === true) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereTitle( $titlebook )
                    ->WhereHasLike( $user )
                    ->WhereHasGood( $user )
                    ->get();
            }
        // タグでの検索
        } elseif( $tagbook ) {
            if ( $like === false && $good === false ) 
            {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->get();
            } elseif ( $like === true && $good === false ) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereHasLike( $user )
                    ->get();
            } elseif ( $like === false && $good === true ) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereHasGood( $user )
                    ->get();
            } elseif ( $like === true && $good === true) {
                $book_search = Book::ReadDB()
                    ->WhereHasTag( $tagbook )
                    ->WhereHasLike( $user )
                    ->WhereHasGood( $user )
                    ->get();
            }
        // タイトルでの検索
        } elseif( $titlebook ) {
            if ( $like === false && $good === false )
            {
                $book_search = Book::ReadDB()
                    ->WhereTitle( $titlebook )
                    ->get();
            } elseif ( $like === true && $good === false ) {
                $book_search = Book::ReadDB()
                    ->WhereTitle( $titlebook )
                    ->WhereHasLike( $user )
                    ->get();
            } elseif ( $like === false && $good === true ) {
                $book_search = Book::ReadDB()
                    ->WhereTitle( $titlebook )
                    ->WhereHasGood( $user )
                    ->get();
            } elseif ( $like === true && $good === true ) {
                $book_search = Book::ReadDB()
                    ->WhereTitle( $titlebook )
                    ->WhereHasLike( $user )
                    ->WhereHasGood( $user )
                    ->get();
            } 
        } else {
            if ( $like === false && $good === false )
            {
                $book_search = Book::ReadDB()
                    ->get();
            } elseif ( $like === true && $good === false ) {
                $book_search = Book::ReadDB()
                    ->WhereHasLike( $user )
                    ->get();
            } elseif ($like === false && $good === true ) {
                $book_search = Book::ReadDB()
                    ->WhereHasGood( $user )
                    ->get();
            } elseif ($like === true && $good === true) {
                $book_search = Book::ReadDB()
                    ->WhereHasLike( $user )
                    ->WhereHasGood( $user )
                    ->get();
            }
        }
        return $book_search;
    }
}