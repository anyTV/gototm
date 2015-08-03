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

Route::get('/', 'RedirectController@index');
Route::get('/{code}', 'RedirectController@goToNewUrl');
Route::get('/{code}/success', 'RedirectController@success');
Route::post('redirect', 'RedirectController@store');
