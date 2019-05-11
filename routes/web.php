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

Route::get('/home', 'HomeController@index')->name('home');

/* #################### Chat routes. #################### */

Route::group(['prefix' => '/chat', 'as' => 'chat.'], function() {

  Route::get('/group', ['as' => 'group', 'uses' => 'ChatController@showGroup']);
  Route::get('/private', ['as' => 'private', 'uses' => 'ChatController@showPrivate']);
  Route::get('/private/{user}', ['as' => 'private.user', 'uses' => 'MessageController@privateMessages']);
  Route::post('/private/{user}', ['as' => 'private.store', 'uses' => 'MessageController@sendPrivateMessages']);
  Route::get('/users', ['as' => 'users', 'uses' => 'ChatController@getUsers']);

});

Route::get('messages', 'MessageController@fetchMessages');
Route::post('messages', 'MessageController@sendMessage');

/* #################### Profile routes. #################### */
Route::group(['prefix' => '/profile', 'as' => 'profile.'], function() {

  Route::get('/', ['as' => 'index', 'uses' => 'ProfileController@showProfile']);

});

/* #################### Voyager admin routes. #################### */
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

/* #################### Authentication routes. #################### */
Auth::routes();

Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});
