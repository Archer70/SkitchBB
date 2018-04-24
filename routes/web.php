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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/users/{name}', 'UserController@show')->name('users.show');
Route::get('/users/{name}/edit', 'UserController@edit')->name('users.edit');
Route::post('/users/{user}/update', 'UserController@update')->name('users.update');

Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store');

Route::get('/categories/{category}/boards/create', 'BoardController@create')->name('boards.create');
Route::post('/categories/{category}/boards/store', 'BoardController@store')->name('boards.store');
Route::get('/boards/{slug}', 'BoardController@show')->name('boards.show');

Route::get('/boards/{slug}/topics/create', 'TopicController@create')->name('topics.create');
Route::post('/boards/{slug}/topics/store', 'TopicController@store')->name('topics.store');
Route::get('/topics/{slug}', 'TopicController@show')->name('topics.show');
Route::post('/topics/{slug}', 'TopicController@destroy')->name('topics.destroy');

Route::post('/posts/store', 'PostController@store')->name('posts.store');
Route::get('/posts/feed', 'PostController@feed')->name('feed');