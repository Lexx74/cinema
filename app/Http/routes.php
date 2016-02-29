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


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('contact', function () {
        return view('contact');
    });

    Route::post('contact/send', 'ContactController@send');

    Route::get('prices', function () {
        return view('prices');
    });

    Route::get('movies', 'MoviesController@index');
    Route::get('movies/{id}/edit', 'MoviesController@edit');
    Route::get('movies/{id}', 'MoviesController@details');

    Route::get('dashboard', 'DashboardController@index');
    Route::get('dashboard/addmovie', 'DashboardController@addMovie');
    Route::post('dashboard/storeMovie', 'DashboardController@storeMovie');
});
