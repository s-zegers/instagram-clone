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

Route::middleware(['web'])->group(function () {
    // Everything authentication related
    Auth::routes();

    Route::middleware(['auth'])->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('profile', 'UserController@index')->name('profile.index');
        Route::get('profile/{id}', 'UserController@show')->name('profile.show');
        Route::get('profile/{id}/edit', 'UserController@edit')->name('profile.edit');
        Route::put('profile/{id}', 'UserController@update')->name('profile.update');
        Route::delete('profile/{id}', 'UserController@destroy')->name('profile.destroy');
        Route::post('profile/{id}/follow', 'UserController@follow')->name('profile.follow');
        Route::post('profile/{id}/unfollow', 'UserController@unfollow')->name('profile.unfollow');
        
        Route::get('posts/create', 'PostController@create')->name('posts.create');
        Route::post('posts', 'PostController@store')->name('posts.store');
        Route::get('posts/{id}', 'PostController@show')->name('posts.show');
        Route::delete('posts/{id}', 'PostController@destroy')->name('posts.destroy');

        Route::get('stories/create', 'StoryController@create')->name('stories.create');
        Route::post('stories', 'StoryController@store')->name('stories.store');

        Route::get('chat', 'ChatController@index');
        Route::get('messages', 'ChatController@fetchMessages');
        Route::post('messages', 'ChatController@sendMessage');
    });
});


