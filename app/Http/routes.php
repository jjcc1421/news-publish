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
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//Route::get('verification/error', 'Auth\AuthController@getVerificationError');
Route::get('/verification/{token}', 'EmailValidatorController@validateEmail');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/news/add', ['as' => 'path_to_add_news', 'uses' => 'NewsController@addNews']);
    Route::get('/news', ['as' => 'path_to_news', 'uses' => 'NewsController@index']);
    Route::post('/news', ['as' => 'path_to_post_news', 'uses' => 'NewsController@save']);
    Route::delete('/news/delete/{articleID}', ['as' => 'path_to_delete_article', 'uses' => 'NewsController@delete']);
    Route::get('/news/remove/{articleID}', ['as' => 'path_to_remove_article', 'uses' => 'NewsController@deleteArticle']);
    Route::get('/news/{articleID}', ['as' => 'path_to_read_article', 'uses' => 'NewsController@readArticle']);
});