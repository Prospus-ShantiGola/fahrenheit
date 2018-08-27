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
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});

Route::group(
[
    'prefix' => 'users',
], function () {

    Route::get('/', 'UsersController@index')
         ->name('users.users.index')->middleware('auth');

    Route::get('/create','UsersController@create')
         ->name('users.users.create')->middleware('auth');

    Route::get('/show/{users}','UsersController@show')
         ->name('users.users.show')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::get('/{users}/edit','UsersController@edit')
         ->name('users.users.edit')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::post('/', 'UsersController@store')
         ->name('users.users.store')->middleware('auth');

    Route::put('users/{users}', 'UsersController@update')
         ->name('users.users.update')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::delete('/users/{users}','UsersController@destroy')
         ->name('users.users.destroy')
         ->where('id', '[0-9]+')->middleware('auth');

});

Route::group(
[
    'prefix' => 'user_reports',
], function () {

    Route::get('/', 'UserReportsController@index')
         ->name('user_reports.user_report.index');

    Route::get('/create','UserReportsController@create')
         ->name('user_reports.user_report.create');

    Route::get('/show/{userReport}','UserReportsController@show')
         ->name('user_reports.user_report.show')
         ->where('id', '[0-9]+');

    Route::get('/{userReport}/edit','UserReportsController@edit')
         ->name('user_reports.user_report.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'UserReportsController@store')
         ->name('user_reports.user_report.store');

    Route::put('user_report/{userReport}', 'UserReportsController@update')
         ->name('user_reports.user_report.update')
         ->where('id', '[0-9]+');

    Route::delete('/user_report/{userReport}','UserReportsController@destroy')
         ->name('user_reports.user_report.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'roles',
], function () {

    Route::get('/', 'RolesController@index')
         ->name('roles.role.index')->middleware('auth');

    Route::get('/create','RolesController@create')
         ->name('roles.role.create');

    Route::get('/show/{role}','RolesController@show')
         ->name('roles.role.show')
         ->where('id', '[0-9]+');

    Route::get('/{role}/edit','RolesController@edit')
         ->name('roles.role.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RolesController@store')
         ->name('roles.role.store');

    Route::put('role/{role}', 'RolesController@update')
         ->name('roles.role.update')
         ->where('id', '[0-9]+');

    Route::delete('/role/{role}','RolesController@destroy')
         ->name('roles.role.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'permissions',
], function () {

    Route::get('/', 'PermissionsController@index')
         ->name('permissions.permission.index');

    Route::get('/create','PermissionsController@create')
         ->name('permissions.permission.create');

    Route::get('/show/{permission}','PermissionsController@show')
         ->name('permissions.permission.show')
         ->where('id', '[0-9]+');

    Route::get('/{permission}/edit','PermissionsController@edit')
         ->name('permissions.permission.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PermissionsController@store')
         ->name('permissions.permission.store');

    Route::put('permission/{permission}', 'PermissionsController@update')
         ->name('permissions.permission.update')
         ->where('id', '[0-9]+');

    Route::delete('/permission/{permission}','PermissionsController@destroy')
         ->name('permissions.permission.destroy')
         ->where('id', '[0-9]+');

});
