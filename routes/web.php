<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Auth
 */
Auth::routes();

Route::get( '/home', 'BookController@BookShow' )->name( 'home' );



/**
 * vueでのページ表示
 */
// ログインのtopページ
Route::get( '/stackerwith/', 'StackedWiteBooks@BookShowTest')->name( 'stacked.home' );

// 詳細ページを表示
Route::get('/stackerwith/detail/{book_id}', 'StackedWiteBooks@BookDetail')->name('stacked.detail');

// ログイン前のtopページ
Route::get('/stackerwith/home', 'StackedWithBooksBefore@BookShowBefore')->name('stacked.before.home');


// おすすめの本を表示
Route::get( 'ajax/booklist', 'Ajax\BooklistController@index' );

// 最近、コメントがあった本の取得、
Route::get( 'ajax/newcomment', 'Ajax\BooklistController@NewComments' );

// tagを取得
Route::get( 'ajax/tags', 'Ajax\TagsController@index' );

// 検索結果を取得
Route::post( 'ajax/search', 'Ajax\SearchController@app' );

//ブックマーク機能
Route::post( 'ajax/goodup', 'Ajax\GoodsController@GoodUp' );
Route::post( 'ajax/gooddown', 'Ajax\GoodsController@GoodDown' );

//いいね機能
Route::post( 'ajax/petup', 'Ajax\PetController@PetUp' );
Route::post( 'ajax/petdown', 'Ajax\PetController@PetDown' );

// コメントを保存
Route::post( '/detail/{book_id}/ajax/comment', 'Ajax\CommentController@app' );

// Route::get( '/stackerwith/{any}', 'BookController@BookShowTest' )->where('any', '.*');