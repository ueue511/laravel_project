<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookFormRequest;

use Illuminate\Http\Request;

use RakutenRws_Client;

class RakutenBookController extends Controller
{
    public function RakutenBookSearch( Request $request )
    {
        $client = new RakutenRws_Client();
        $book_name = $request->item_name;

        define( 'RAKUTEN_APPLICATION_ID', config('app.rakuten_id') );
        $client->setApplicationId(RAKUTEN_APPLICATION_ID);

        $response = $client->execute( 'BooksBookSearch', array(
            'title' => $book_name
        ) );

        if( $response->isOk() ) {
            $items = [];
            foreach( $response as $key => $item ) {
                $items[$key]['item_name'] = $item['title'];
                $items[$key]['item_amount'] = $item['itemPrice'];
                $items[$key]['published'] = $item['salesDate'];
                $items[$key]['item_url'] = $item['itemUrl'];
                $items[$key]['caption'] = $item['itemCaption'];

                if ($item['largeImageUrl']) {
                    $imgSrc = $item['largeImageUrl'];
                    $items[$key]['item_img'] = preg_replace('/^http:/', 'https:', $imgSrc);
                }
            }
            $items_json = json_encode($items);
            return $items_json;
        } else {
            return 'Error:'.$response->getMessage();
        }
    }
}