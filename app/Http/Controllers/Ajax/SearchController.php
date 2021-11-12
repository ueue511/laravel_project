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
        
        // $tag_data = Tag::find( $tagbook );
        // $book = $tag_data->books;

        $book = book::with(['commentsusers', 'tags', 'goodsusers', 'petsusers'])
        ->whereHas('tags', function($query) use ($tagbook)
        {
            $query->where('tag_id', $tagbook);
        });
        
        return $book;
        
    }
}

$book = App\book::with(['tags' => function($query){$query->find( 3 );
}, 'goodsusers', 'petsusers', 'commentsusers',])->first();

$book = App\tag::find(3)->books->with(['goodsusers', 'petsusers', 'commentsusers',])->first();