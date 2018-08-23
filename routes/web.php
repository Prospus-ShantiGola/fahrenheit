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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(
[
    'prefix' => 'users',
], function () {

    Route::get('/', 'UsersController@index')
         ->name('users.users.index')->middleware('auth');;

    Route::get('/create','UsersController@create')
         ->name('users.users.create')->middleware('auth');;

    Route::get('/show/{users}','UsersController@show')
         ->name('users.users.show')
         ->where('id', '[0-9]+')->middleware('auth');;

    Route::get('/{users}/edit','UsersController@edit')
         ->name('users.users.edit')
         ->where('id', '[0-9]+')->middleware('auth');;

    Route::post('/', 'UsersController@store')
         ->name('users.users.store')->middleware('auth');;

    Route::put('users/{users}', 'UsersController@update')
         ->name('users.users.update')
         ->where('id', '[0-9]+')->middleware('auth');;

    Route::delete('/users/{users}','UsersController@destroy')
         ->name('users.users.destroy')
         ->where('id', '[0-9]+')->middleware('auth');;

});
