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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'register'], function() {
    Route::get('', ['as' => 'users.get-register', 'uses' => 'UserAuthController@getRegister']);
    Route::post('', ['as' => 'users.post-register', 'uses' => 'UserAuthController@postRegister']);
});

Route::group(['prefix' => 'login'], function() {
    Route::get('', ['as' => 'users.get-login', 'uses' => 'UserAuthController@getLogin']);
    Route::post('', ['as' => 'users.post-login', 'uses' => 'UserAuthController@postLogin']);
});

Route::get('logout', ['as' => 'users.logout', 'uses' => 'UserAuthController@logout']);
