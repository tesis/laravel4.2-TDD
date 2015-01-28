<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('register',['uses'=>'UserController@create','as' => 'users.create']);
Route::post('register',['uses'=>'UserController@store','as' => 'users.store']);

Route::get('login',['uses'=>'LoginController@create','as' => 'login.create']);
Route::post('login',['uses'=>'LoginController@store','as' => 'login.store']);
Route::get('logout',['uses'=>'LoginController@destroy','as' => 'login.destroy']);


Route::resource('users', 'UserController');
