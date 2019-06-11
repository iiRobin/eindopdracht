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

Route::get('/test', function() {
  return Auth::user()->test();
});

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

  Route::get('/requests', ['as' => 'requests', 'uses' => 'ProfileController@showRequests']);
  Route::get('/friends', ['as' => 'friends', 'uses' => 'ProfileController@showFriends']);
  Route::get('/{user}', ['as' => 'index', 'uses' => 'ProfileController@showProfile']);
  Route::post('/{user}/add', ['as' => 'addfriend', 'uses' => 'FriendController@sendFriendRequest']);
  Route::post('/{user}/remove', ['as' => 'removefriend', 'uses' => 'FriendController@removeFriend']);
  Route::post('/{user}/accept', ['as' => 'acceptfriend', 'uses' => 'FriendController@acceptFriendRequest']);
  Route::post('/{user}/decline', ['as' => 'declinefriend', 'uses' => 'FriendController@declineFriendRequest']);

  Route::post('/edit', ['as' => 'edit', 'uses' => 'ProfileController@update']);
  Route::post('/image', ['as' => 'upload', 'uses' => 'ProfileController@upload']);

  Route::post('/post', ['as' => 'post', 'uses' => 'PostController@create']);
  Route::post('/comment', ['as' => 'comment', 'uses' => 'PostController@createComment']);
  Route::get('/comment/{comment}/delete', ['as' => 'comment.delete', 'uses' => 'PostController@deleteComment']);
  Route::get('/post/{post}/delete', ['as' => 'post.delete', 'uses' => 'PostController@deletePost']);

});

Route::group(['prefix' => 'api'], function () {

  Route::post('post/like', ['as' => 'post.liked.toggle', 'uses' => 'PostController@toggleLiked']);

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
