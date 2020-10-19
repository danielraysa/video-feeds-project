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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => 'web','auth'], function () {
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::resource('/videos', 'VideoController');
    Route::resource('/comment', 'CommentController');
    Route::post('/videos/{id}/like', 'LikeController@store')->name('like');
    Route::post('/videos/{id}/comment', 'CommentController@store')->name('comment');
    Route::post('/videos/{id}/comment/update', 'CommentController@store')->name('update-comment');
    Route::resource('/users', 'UserController');
});
