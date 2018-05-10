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

// USERS
Route::get('/users/{user}', 'UserController@show')->name('users.show');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::post('/users/{user}/update', 'UserController@update')->name('users.update');
Route::post('/users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
Route::post('/users/{user}/ban', 'UserController@ban')->name('users.ban');
Route::post('/users/{user}/unban', 'UserController@unban')->name('users.unban');
Route::get('/banned', function() {
    return view('banned');
})->name('users.banned');
Route::get('/permission-denied', function() {
    return view('permission_denied');
})->name('users.permission_denied');

// CATEGORIES
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::post('/categories/{category}/update', 'CategoryController@update')->name('categories.update');
Route::post('/categories/{category}/destroy', 'CategoryController@destroy')->name('categories.destroy');

// BOARDS
Route::get('/categories/{category}/boards/create', 'BoardController@create')->name('boards.create');
Route::post('/categories/{category}/boards/store', 'BoardController@store')->name('boards.store');
Route::get('/boards/{board}/{slug?}', 'BoardController@show')->name('boards.show');
Route::post('/boards/{board}/edit', 'BoardController@edit')->name('boards.edit');

// TOPICS
Route::get('/topics/{topic}/{slug?}', 'TopicController@show')->name('topics.show');

Route::get('/boards/{board}/topics/create', 'TopicController@create')->name('topics.create');
Route::get('/boards/{board}/{slug}/topics/create', 'TopicController@create')->name('topics.create');

Route::post('/boards/{board}/topics/store', 'TopicController@store')->name('topics.store');
Route::post('/boards/{board}/{slug}/topics/store', 'TopicController@store')->name('topics.store');

Route::post('/topics/{topic}/destroy', 'TopicController@destroy')->name('topics.destroy');
Route::post('/topics/{topic}/{slug}/destroy', 'TopicController@destroy')->name('topics.destroy');

// POSTS
Route::post('/posts/store', 'PostController@store')->name('posts.store');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
Route::post('/posts/{post}/update', 'PostController@update')->name('posts.update');
Route::post('/posts/{post}/destroy', 'PostController@destroy')->name('posts.destroy');
Route::get('/posts/feed', 'PostController@feed')->name('feed');

// SEARCH

Route::post('/searches/create', 'SearchController@create')
    ->name('searches.create')
    ->middleware('throttle:30,1'); // Thirty searches a minute per user.
