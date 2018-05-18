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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// USERS
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('/users/{user}/update', 'UserController@update')->name('users.update');
Route::post('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
Route::post('/users/{user}/ban', 'UserController@ban')->name('users.ban');
Route::post('/users/{user}/unban', 'UserController@unban')->name('users.unban');
Route::get('/banned', 'UserController@banned')->name('users.banned');
Route::get('/permission-denied', 'UserController@permissionDenied')->name('users.permission_denied');

// CATEGORIES
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::post('/categories/{category}/update', 'CategoryController@update')->name('categories.update');
Route::post('/categories/{category}/destroy', 'CategoryController@destroy')->name('categories.destroy');

// BOARDS
Route::get('/categories/{category}/boards/create', 'BoardController@create')->name('boards.create');
Route::post('/categories/{category}/boards/store', 'BoardController@store')->name('boards.store');
Route::get('/boards/{board}/edit', 'BoardController@edit')->name('boards.edit');
Route::post('boards/{board}/update', 'BoardController@update')->name('boards.update');
Route::post('boards/{board}/destroy', 'BoardController@destroy')->name('boards.destroy');
Route::get('/boards/{board}/{slug?}', 'BoardController@show')->name('boards.show');

// TOPICS
Route::get('/boards/{board}/topics/create', 'TopicController@create')->name('topics.create');
Route::post('/boards/{board}/topics/store', 'TopicController@store')->name('topics.store');
Route::get('/topics/{topic}/edit', 'TopicController@edit')->name('topics.edit');
Route::post('/topics/{topic}/update', 'TopicController@update')->name('topics.update');
Route::post('/topics/{topic}/destroy', 'TopicController@destroy')->name('topics.destroy');
Route::get('/topics/{topic}/{slug?}', 'TopicController@show')->name('topics.show');

// POSTS
Route::post('/posts/store', 'PostController@store')->name('posts.store');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::post('/posts/{post}/update', 'PostController@update')->name('posts.update');
Route::post('/posts/{post}/destroy', 'PostController@destroy')->name('posts.destroy');
Route::get('/posts/feed', 'PostController@feed')->name('feed');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::get('/posts/newer-than/{lastPost}', 'PostController@loadNew')->name('posts.newer-than');

// SEARCH
Route::match(['post', 'get'], '/searches/create', 'SearchController@create')
    ->name('searches.create')
    ->middleware('throttle:30,1'); // Thirty searches per minute, per user.
