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

Route::group(['prefix' => 'higherlower'], function() {

    Route::get('',          'CardController@index');

	Route::get('shuffle',	'CardController@shuffleDeck');

    Route::get('higher',    'CardController@higher');
    Route::get('lower',     'CardController@lower');
});


