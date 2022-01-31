<?php

namespace App\Http\Controllers;

use App\Http\Requests\RakutenApiFormRequest;

class ModalBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    
    public function Show( RakutenApiFormRequest $request ) 
    {
        $request->session()->flash('message_id', 'rakuten');

        $published = $request->published;
        $target = array('年', '月', '日', '頃');
        $published_replace = str_replace($target, '-', $published);
        
        $published_end = strlen($published_replace) === 8? $published_replace. '01':trim($published_replace, '-');

        $request->session()->flash(
            '_old_input', [
                '_token' => $request->_token,
                '_method' => $request->_method,
                'item_name' => $request->item_name,
                'item_amount' => $request->item_amount,
                'item_img' => $request->item_img,
                'published' => $published_end,
                'item_url' => $request->item_url,
            ]
        );
        
        return redirect( '/admin' )->with([]);
    }
}