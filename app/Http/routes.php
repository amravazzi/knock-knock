<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/user/register', function () {
//     return view('auth.register');
// });
//
// Route::get('/user/login', function () {
//     return view('auth.login');
// });
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');

    Route::get('/user/register', 'HomeController@insideRegister');

    Route::get('/user/login', 'HomeController@insideLogin');

    Route::get('/message/add', 'HomeController@messageAdd');

    Route::get('/message/list', 'HomeController@messageList');

    Route::post('/messages/add', 'MessageController@store');
});
