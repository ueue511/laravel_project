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
// test vue
Route::get( '/sample/', 'BookController@BookShowTest');

// おすすめの本を表示
Route::get( 'ajax/booklist', 'Ajax\BooklistController@index' );

// tagを取得
Route::get( 'ajax/tags', 'Ajax\TagsController@index' );

// 検索結果を取得
Route::post( 'ajax/search', 'Ajax\SearchController@app');

Route::get('/sample/{any}', 'BookController@BookShowTest')->where('any', '.*');