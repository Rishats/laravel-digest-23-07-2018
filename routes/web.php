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

Route::get('/users/only-trashed', 'UsersController@onlyTrashed')->name('onlyTrashed');
Route::get('/users/with-trashed', 'UsersController@withTrashed')->name('withTrashed');
Route::get('/users/trashed-user/{id}', 'UsersController@showTrashed')->name('showTrashed');
Route::patch('/users/trashed-user/{id}', 'UsersController@restoreTrashed')->name('restoreTrashed');
Route::delete('/users/trashed-user/{id}', 'UsersController@destroyPermanently')->name('destroyPermanently');
Route::resource('users', 'UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
