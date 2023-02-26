<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login')->name("auth.login");
    Route::post('logout', 'AuthController@logout')->name("auth.logout");
    Route::post('refresh', 'AuthController@refresh')->name("auth.refresh");
    Route::post('me', 'AuthController@me')->name("auth.me");
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::apiResources([
        'user' => 'UserController',
    ]);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/client', 'ClientController');
    Route::apiResource('/access', 'AccessController');
    Route::apiResource('/accessTemplate', 'AccessTemplateController');
    Route::apiResource('/accessType', 'AccessTypeController');

});