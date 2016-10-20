<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();
Route::get('/', 'HomeController@index')->name("main");
Route::get('/home', 'HomeController@index');
Route::get('/minor', 'HomeController@minor')->name("minor");
Route::get('/logout', array('uses' => '\App\Http\Controllers\Auth\LogoutController@getSignOut'));

Route::get('/users', 'UserController@show');
Route::any('/users/createAdmin', array('uses' => 'UserController@createAdmin'));
Route::any('/users/createCustomer', 'UserController@createCustomer');
Route::any('/videos', 'VideoController@show');
Route::any('/videos/upload', 'VideoController@uploadVideo');
Route::post('/videos/create', 'VideoController@createVideo');
Route::any('/video/detail/{videoid}', 'VideoController@detail');
