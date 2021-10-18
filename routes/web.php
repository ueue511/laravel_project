<?php

use App\Book;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 本の一覧表示（books.blade.php） 
 */
Route::get( '/', 'BookController@BookShow' )->name( 'top.contact' );

/**
 * 本の新規追加
 */
Route::post( '/books', 'BookController@BookCreate' );
// Route::post('/books', function( Request $request ) {
//     // バリデーション
//     $validator = Validator::make ( 
//         $request->all(), [ 
//             'item_name'=>'bail|required|between:3, 255', 
//             'item_number'=>'bail|required|integer|digits_between:1,3', 
//             'item_amount'=>'bail|required|integer|digits_between:1,6', 
//             'published'=>'bail|required|date|before:today', 
//         ],
//         // バリデーション オリジナルコメント
//         [
//             'item_name.required' => 'タイトルを入力してください',
//             'item_name.between' => 'タイトルは３文字〜255以内で入力してください',
//             'item_number.required' => '冊数を入力してください',
//             'item_number.integer' => '半角数字で入力してください',
//             'item_number.digits_between' => '999以内で入力してください',
//             'item_amount.required' => '金額を入力してください',
//             'item_amount.integer' => '半角数字で入力してください',
//             'item_amount.digits_between' => '￥999999以内で入力してください',
//             'published.required' => '本公開日を指定してください',
//             'published.before' => '本日から以前の年月日を指定してください',
//         ],
//     );
    
//     // バリデーション：エラー
//     if( $validator->fails() ) {
//         return redirect( '/' )
//           ->withInput()
//           ->withErrors( $validator );
//     };

//     // Eloquentモデル (登録処理)
//     $books = new Book;
//     $books->item_name = $request->item_name;
//     $books->item_number = $request->item_number;
//     $books->item_amount = $request->item_amount;
//     $books->published = $request->published;
//     $books->save();
//     $request->session()->flash('message', '新規登録');
//     return redirect( '/' )->withInput();
// } );

/**
 * 本の詳細を取得する
 */

Route::get( '/book/{book}', 'BookController@BookMake')->name('add_contact');

/**
 * 本の詳細の変更を保存
 */

Route::put( '/book/{book}', 'BookController@BookAdd');

/**
 * 本を削除する
 */

Route::delete( '/book/{book}/delete', 'BookController@BookDelete' );


Auth::routes();

Route::get( '/home', 'HomeController@index' )->name( 'home' );