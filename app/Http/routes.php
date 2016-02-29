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

    // if( ! \Auth::check() )
    // {
    //   //dd(\Auth::check());
    //     Route::get('/user/register', function () {
    //         return view('auth.register');
    //     });
    // } else {
    //     // \HomeController::logNavigation();
    //     // \HomeController::verifySequence();
    //     // Route::get('/user/register', 'HomeController@insideRegister');
    // }


});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');

    Route::get('/message/add', 'HomeController@messageAdd');

    Route::get('/message/list', 'HomeController@messageList');

    Route::post('/messages/add', 'MessageController@store');

    Route::get('/user/register', function (App\Http\Controllers\HomeController $home) {
        if( ! \Auth::check() )
        {
            return view('auth.register');
        } else {
            $home->logNavigation();
            $home->verifySequence();
            return view('auth.register');
        }
    });

    Route::get('/user/login', function (App\Http\Controllers\HomeController $home) {
        if( ! \Auth::check() )
        {
            return view('auth.login');
        } else {
            $home->logNavigation();
            $home->verifySequence();
            return view('auth.login');
        }
    });
});
