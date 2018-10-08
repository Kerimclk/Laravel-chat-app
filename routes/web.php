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

Route::get('/friends','FriendsController@index');
Route::get('/friends/add/{id}','FriendsController@add');
Route::get('/friends/notification','FriendsController@notification');
Route::get('/friends/confirm/{id}','FriendsController@confirm');

Route::get('/profil-duzenle','HomeController@profilDuzenle');
Route::post('/profil-duzenle','HomeController@profilDuzenlePost');

Route::get('/messages/{user_id}','MessageController@index');
Route::post('/message/send','MessageController@AjaxMessageSend');
Route::post('/message/getMessage','MessageController@getMessage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
