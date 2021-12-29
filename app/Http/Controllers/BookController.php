<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookFormRequest;
use Storage;

use App\Book;
use App\Tag;
use Auth;
use File;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
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
        $tags = Tag::all();
        
        if( $message_id === 'create') {
            $alert_type = 'alert-success';
            $book_one = Null;
            $old_itemname = old('item_name');
            
            $request->session()->forget('_old_input');
            // ddd($request->session()->all());
            $request->session()->flash('message', '新規登録');
            $request->session()->flash('old_itemname', $old_itemname);

            return view( 'books' )->with([
                'books' => $books,
                'book_one' => $book_one,
                'alert' => $alert_type,
                'tags' => $tags,
            ]);
            
        } elseif ( $message_id === 'danger' ) {
            $request->session()->flash( 'message', '記述に誤りがあります' );
            $alert_type = 'alert-danger';
            
            if ( session( 'back_id' ) ) {
                $book_one = [ Book::find( session( 'back_id' ) ) ];
                $book_id = session( 'back_id' );

                // ddd('1'. $book_one);
                
                return view('books')->with([
                    'books' => $books,
                    'book_one' => $book_one,
                    'alert' => $alert_type,
                    'book_id' => $book_id,
                    'tags' => $tags,
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
                'book_name' => $book_name,
                'tags' => $tags,
        ]);
            
        } else {
            session()->forget( 'message', 'message_id', 'back_id', 'filename'); //sessionリセット
            $alert_type = Null;
            $book_one = Null;
        }
        return view( 'books' )->with ([
            'books' => $books, 
            'book_one' => $book_one,
            'alert' => $alert_type,
            'tags' => $tags,
        ]);
     }

    /**
     * 本の新規追加
     */
    
     public function BookCreate( BookFormRequest $request ) 
     {
        // 画像保存
        $file = $request->file( 'item_img' ); //file取得
        $target_path_temporary = public_path('temporary/');
        $target_path = public_path('update/');
        
        if( !empty( $file ) ) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            file_exists($target_path_temporary  . $filename) ? File::delet($target_path, $filename) : '';
            $file->move( $target_path, $filename );  //ファイルを移動
            
        } else {
            $filename = $request->item_img;
            $temporary_files = File::files($target_path_temporary);
            foreach($temporary_files as $file) {
                $file->getfileName() === $filename? File::move( $target_path_temporary . $filename, $target_path . $filename):'';
                File::delete( $target_path_temporary, $filename);
            }
            
        }
        
        // Eloquentモデル (登録処理)
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_amount = $request->item_amount;
        $books->item_img = $filename;
        $books->published = $request->published;
        $books->save();

        $tags = $request->book_tag;

        foreach($tags as $value) {
            $books->Tags()->attach($value);
        }

        $request->session()->flash( 'message_id', 'create' );
        
        return redirect( '/' )->withInput();
    }
    //  
    /**
     * 本の詳細を表示
     */
    
    public function BookMake( Request $request, Book $book ) {
        
        $books = Book::where( 'user_id', Auth::user()->id )->orderBy( 'created_at', 'asc' )->paginate(3);
        $tags = Tag::all();
        
        $book_one = Book::with('tags')->where( 'id', $book->id )->get();
        $book_id = $book->id;
        $book_name = $book->item_name;
        $tag = $book_one[0]->tags->toArray();
        
        $book_tag =[];
        foreach($tag as $value){
            array_push($book_tag, $value['id']);
        }
        $alert = 'alert-info';
        $request->session()->flash( 'message', '詳細を表示' );

        // ddd('2' . $book_one[0]) //詳細ボタン;
        
        return view( 'books' )->with([ 
            'books' => $books,
            'book_one' => $book_one[0],
            'book_id' => $book_id,
            'book_name' => $book_name,
            'alert' => $alert,
            'book_tag' => $book_tag,
            'tags' => $tags,
        ]);
    }

    /**
     * 本の詳細の変更を保存
     */

     public function BookAdd( BookFormRequest $request, Book $book ) 
     {
        // 画保保存
        $file = $request->file('item_img'); //file取得
        if (!empty($file)) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            $target_path = public_path('update/');
            $target_path_temporary = public_path('temporary/');
            file_exists($target_path_temporary  . $filename)? Storage::delet($target_path, $filename) : '';
            $file->move($target_path, $filename);  //ファイルを移動

        } else {
            $filename = $request->item_img;
        }
        
        $book->update([
            'item_name' => $request->item_name,
            'item_amount' => $request->item_amount,
            'item_img'  => $filename,
            'published' => $request->published . " 00:00:00"
        ]);

        // $book_one_tags: 現在のbookのタグ一覧
        // tags: requestで受け取った選択されたtag一覧
        // tag_array: tagsをarrayに変換
        
        $book_one_tags = Book::with('tags')->where('id', $book->id)->get();
        $tag_array = [];
        $tags = $request->book_tag;
        
        foreach($book_one_tags[0]->tags as $value) {
            array_push($tag_array, $value->id);
        };

        // 両方の配列を比較し差分のみを取り出す 必ず配列大-小での差分計算(array_diff)で判断
        count($tag_array) > count($tags)? $book_tag_array = array_diff($tag_array, $tags): $book_tag_array = array_diff($tags, $tag_array);
        
        // toggleでのonoff
        $book->Tags()->toggle($book_tag_array);
        
        $request->session()->forget('back_id');
        $books = Book::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->paginate(3);
        $tags = Tag::all();
        $book_one = Book::find( $book->id );
        $book_id = $book->id;
        $book_name = $book->item_name;

        $tag = $book_one->tags->toArray();

        $book_tag = [];
        foreach ($tag as $value) {
            array_push($book_tag, $value['id']);
        }
        
        $alert = 'alert-warning';
        $request->session()->flash( 'message', '詳細を変更' );

        // ddd('3' . $book_one); //詳細を変更
        
        return view( 'books' )->with ([
            'books' => $books,
            'book_one' => $book_one,
            'book_id' => $book_id,
            'book_name' => $book_name,
            'alert' => $alert,
            'book_tag' => $book_tag,
            'tags' => $tags,
        ]);
     }

    /**
     * 本を削除する
     */
    public function BookDelete( Request $request, Book $book ) 
    {
        $request->session()->flash( 'back_name', $book->item_name );
        $book->Tags()->detach();
        $book->delete();
        $request->session()->flash( 'message_id', 'delete' );
        return redirect('/');
    }

    /**
     * 本の画像処理
     */
   public function BookImgMake( $file, $request, $add )
    {
        if (!empty($file)) {               //fileが空かチェック
            $filename = $file->getClientOriginalName();  //ファイル名を取得
            $target_path = public_path('update/');
            $target_path_temporary = public_path('temporary/');
            file_exists($target_path_temporary  . $filename) ? Storage::delet($target_path, $filename) : '';
            $file->move($target_path, $filename);  //ファイルを移動

        } else {
            $add ? $filename = $request->item_img: $filename = '';
        }
   }
}