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
Route::get('/user', 'UserController@show');
Route::get('/', 'HomeController@index')->name("main");
Route::get('/minor', 'HomeController@minor')->name("minor");
Route::get('/logout', array('uses' => '\App\Http\Controllers\Auth\LogoutController@getSignOut'));
Auth::routes();

Route::get('/home', 'HomeController@index');
