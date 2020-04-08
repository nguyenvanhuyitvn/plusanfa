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
<<<<<<< HEAD
use App\Events\HistoryStatusDevice;
=======
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9

Auth::routes();
Route::get('/reset-password', 'Users\UsersController@resetPassword')->name('users.reset.password');
Route::post('/reset-password', 'Users\UsersController@saveResetPassword')->name('users.reset.password');
Route::group(['prefix' => 'admin', 'middleware'=>'apiCheckLogout'], function () {
    
    Route::get('/home', 'HomeController@index')->name('dashboard');
    // Get device
    Route::get('/device/{locationId}', 'HomeController@getDeviceByLocationId')->name('device.location');
<<<<<<< HEAD

    Route::group(['prefix' => 'users', 'namespace'=>'Users'], function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::post('/update', 'UsersController@update')->name('users.update');
    });
    
    Route::group(['prefix' => 'location', 'namespace' => 'Locations'], function() {
        Route::get('', 'LocationController@index')->name('location.index');
        Route::get('/create', 'LocationController@create')->name('location.create');
        Route::post('/store', 'LocationController@store')->name('location.store');
        Route::get('/edit/{id}', 'LocationController@edit')->name('location.edit');
        Route::post('/update/{id}', 'LocationController@update')->name('location.update');
        Route::post('/checkDelete/{id}', 'LocationController@checkDelete')->name('location.checkDelete');
        Route::get('/delete/{id}','LocationController@destroy')->name('location.delete');
    });
    Route::group(['prefix' => 'device', 'namespace' => 'Devices'], function() {
        Route::get('', 'DeviceController@index')->name('device.index');
        Route::get('/edit/{id}', 'DeviceController@edit')->name('device.edit');
        Route::post('/update/{id}', 'DeviceController@update')->name('device.update');
        Route::get('/updateHistory/{id}', 'DeviceController@updateHistory')->name('device.update.history');
        Route::get('/getSchedule/{id}', 'DeviceController@getSchedule')->name('device.schedule');
        Route::post('/checkDelete/{id}', 'DeviceController@checkDelete')->name('device.checkDelete');
        Route::get('/delete/{id}','DeviceController@destroy')->name('device.delete');
    });


    Route::get('/fireEvent', function() {
        event(new HistoryStatusDevice());
=======

    Route::group(['prefix' => 'users', 'namespace'=>'Users'], function() {
        Route::get('/', 'UsersController@index')->name('users.index');
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::post('/update', 'UsersController@update')->name('users.update');
    });
    
    Route::group(['prefix' => 'location', 'namespace' => 'Locations'], function() {
        Route::get('', 'LocationController@index')->name('location.index');
        Route::get('/create', 'LocationController@create')->name('location.create');
        Route::post('/store', 'LocationController@store')->name('location.store');
        Route::get('/edit/{id}', 'LocationController@edit')->name('location.edit');
        Route::post('/update/{id}', 'LocationController@update')->name('location.update');
        Route::post('/checkDelete/{id}', 'LocationController@checkDelete')->name('location.checkDelete');
        Route::get('/delete/{id}','LocationController@destroy')->name('location.delete');
    });
    Route::group(['prefix' => 'device', 'namespace' => 'Devices'], function() {
        Route::get('', 'DeviceController@index')->name('device.index');
        Route::get('/edit/{id}', 'DeviceController@edit')->name('device.edit');
        Route::post('/update/{id}', 'DeviceController@update')->name('device.update');
        Route::post('/checkDelete/{id}', 'DeviceController@checkDelete')->name('device.checkDelete');
        Route::get('/delete/{id}','DeviceController@destroy')->name('device.delete');
>>>>>>> 86a57651dcb8ea41b588d9a1a10007c82bc3b5f9
    });
});
