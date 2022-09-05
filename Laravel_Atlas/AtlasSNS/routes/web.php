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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ログインしてない人はトップページに戻るように

use App\Http\Controllers\UsersController;

Route::group(['middleware' => 'guest'], function(){

Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

});

Route::group(['middleware' => 'auth'], function(){

  Route::resource('users', 'UsersController',['only' => ['index', 'show']]);

Route::get('/top','PostsController@index');

Route::get('/search','UsersController@search');
Route::get('follows/users/profile/{id}','UsersController@profile');
Route::get('/edit','UsersController@edit');

Route::post('/users/update','UsersController@update');

Route::get('follows/follow/{id}','UsersController@follow')->name('follows.follow');
Route::get('follows/unfollow/{id}','UsersController@unfollow')->name('follows.unfollow');

Route::get('/followList','FollowsController@followList');
Route::get('/followerList','FollowsController@followerList');

//👇投稿のためのルート
//Route::resource('/', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
Route::post('posts/create', 'PostsController@create')->name('create');

Route::post('posts/delete/{id}', 'PostsController@delete');

Route::post('posts/update/{id}', 'PostsController@update');

//Route::post('posts/update/{id}', 'PostsController@update');
});


//Route::get('/profile','UsersController@profile')
//->name('profile');

Route::get('/logout', 'UsersController@logout')->name('logout');
