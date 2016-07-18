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

Route::any('ping', function () {
    return json_encode(['message' => 'pong']);
});

Route::get('/', 'RedirectController@index');
Route::controller('/au', 'Auth\AuthController');

Route::group(['middleware' => 'auth'], function () {
    Route::controller('/my', 'UserController');
    Route::controller('/api/my', 'Api\UserController');
});

Route::controller('/api/thirdParty', 'Api\ThirdPartyController');

Route::group([
    'prefix' => '/{code}',
    'where' => ['code' => '(.*)'],
], function()
{
    Route::get('success', 'RedirectController@success');
    Route::get('/', 'RedirectController@goToNewUrl');
});

Route::post('redirect', ['middleware' => 'auth', 'uses' => 'RedirectController@store']);
