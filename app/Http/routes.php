<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    Flash::message('Welcome aboard!');
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Route::get('verification/error', 'Auth\AuthController@getVerificationError');
Route::get('verification/{token}', 'EmailValidatorController@validateEmail');
