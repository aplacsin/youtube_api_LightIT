<?php

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

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::resource('youtube','YoutubePlayerController'); */

Auth::routes();

Route::get('/', 'YoutubePlayerController@index')->name('youtube');

Route::get('search', 'YoutubePlayerController@search')->name('youtube.search');

Route::post('favorite/{video_id}', 'YoutubePlayerController@favoriteVideo')->name('youtube.favorite');
Route::post('unfavorite/{video_id}', 'YoutubePlayerController@unFavoriteVideo')->name('youtube.unfavorite');

Route::get('likes', 'UsersController@myFavorites')->name('youtube.likes');