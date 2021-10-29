<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest;

use App\Book;
use Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**変数指定
     * book_one: 詳細表示の有無
     * messege_id: どのメッセージか判定
     * [create: 新規登録, danger: 登録ミス, detail: 詳細, delete: 削除]
     * 
     */

     
    /**
     * 本の一覧表示（books.blade.php） 
     */

     public function BookShow( Request $request ) {
        $books = Book::where( 'user_id', Auth::user()->id )->orderBy( 'created_at', 'asc' )->paginate(3);
        $message_id = session( 'message_id' );
        
        if( $message_id === 'create') {
            $request->session()->flash( 'message', '新規登録');
            $alert_type = 'alert-success';
            $book_one = Null;
            
        } elseif ( $message_id === 'danger' ) {
            $request->session()->flash( 'message', '記述に誤りがあります' );
            $alert_type = 'alert-danger';
            
            // if ( url()->previous() != url('').'/' ) {
            if ( session( 'back_id' ) ) {
                $book_one = [ Book::find( session( 'back_id' ) ) ];
                $book_id = session( 'back_id' );

                return view('books')->with([
                    'books' => $books,
                    'book_one' => $book_one,
                    'alert' => $alert_type,
                    'book_id' => $book_id
                ]);
                
            } else {
                $book_one = Null;
            }
        
        } elseif ( $message_id === 'delete' ) {
            $request->session()->flash( 'message', '削除しました' );
            $alert_type = 'alert-secondary';
            $book_name = session('back_name');

            $book_one = Null;

            return view( 'books' )->with ([
                'books' => $books, 
                'book_one' => $book_one,
                'alert' => $alert_type,
                'book_name' => $book_name
        ]);
            
        } else {
            session()->forget('message', 'message_id', 'back_id');
            $alert_type = Null;
            $book_one = Null;
        }
        return view( 'books' )->with ([
            'books' => $books, 
            'book_one' => $book_one,
            'alert' => $alert_type
        ]);
     }

    /**
     * 本の新規追加
     */
    
     public function BookCreate( BookFormRequest $request ) {
         
        // 画像保存
        $file = $request->file( 'item_img' ); //file取得
        if( !empty( $file ) ) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            $target_path = public_path( 'update/' );
            $file->move( $target_path, $filename );  //ファイルを移動
            
        } else {
            $filename ="";
        }

        // Eloquentモデル (登録処理)
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->item_img = $filename;
        $books->published = $request->published;
        $books->save();
        $request->session()->flash( 'message_id', 'create' );
        return redirect( '/' )->withInput(); 
        }
    //  
    /**
     * 本の詳細を表示
     */
    
    public function BookMake( Request $request, Book $book ) {
        
        $books = Book::where( 'user_id', Auth::user()->id )->orderBy( 'created_at', 'asc' )->paginate(3);
        $book_one = Book::find( $book->id );
        $book_id = $book->id;
        $book_name = $book->item_name;
        $alert = 'alert-info';
        $request->session()->flash( 'message', '詳細を表示' );
        return view( 'books' )->with([ 
            'books' => $books,
            'book_one' => $book_one,
            'book_id' => $book_id,
            'book_name' => $book_name,
            'alert' => $alert
        ]);
    }

    /**
     * 本の詳細の変更を保存
     */

     public function BookAdd( BookFormRequest $request, Book $book ) {

         // ファイルパスの判定
        $filepath = public_path('/update/'. $book['item_img']);
        if ( \File::exists( $filepath ) ) {
            $validator_img = 'bail|required';
        } else {
            $validator_img= 'bail|required|image|mimes:jpeg,png,jpg,gif';
        }
        
        // 画保保存
        $file = $request->file('item_img'); //file取得
        if (!empty($file)) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            $target_path = public_path('update/');
            $file->move($target_path, $filename);  //ファイルを移動

        } else {
            $filename = "";
        }
        
        $book->update([
            'item_name' => $request->item_name,
            'item_number' => $request->item_number,
            'item_amount' => $request->item_amount,
            'item_img'  => $filename,
            'published' => $request->published . " 00:00:00"
        ]);
        $request->session()->forget('back_id');
        $books = Book::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
        $book_one = Book::find( $book->id );
        $book_id = $book->id;
        $book_name = $book->item_name;
        $alert = 'alert-warning';
        $request->session()->flash( 'message', '詳細を変更' );
        
        return view( 'books' )->with ([
            'books' => $books,
            'book_one' => $book_one,
            'book_id' => $book_id,
            'book_name' => $book_name,
            'alert' => $alert
        ]);
     }

    /**
     * 本を削除する
     */
    public function BookDelete( Request $request, Book $book ) {
        $request->session()->flash( 'back_name', $book->item_name );
        $book->delete();
        $request->session()->flash( 'message_id', 'delete' );
        return redirect('/');
    }
}