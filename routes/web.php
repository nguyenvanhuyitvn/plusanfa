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
Route::group(['prefix' => 'admin', 'middleware'=>'apiCheckLogout'], function () {
    Route::get('/users', 'Users\UsersController@index')->name('users.index');
    Route::get('/users/edit', 'Users\UsersController@edit')->name('users.edit');
    Route::post('/users/update', 'Users\UsersController@update')->name('users.update');
    Route::get('/users/reset-password', 'Users\UsersController@resetPassword')->name('users.reset.password');
    Route::post('/users/reset-password', 'Users\UsersController@saveResetPassword')->name('users.reset.password');
});

Route::get('/home', 'HomeController@index')->name('home');
