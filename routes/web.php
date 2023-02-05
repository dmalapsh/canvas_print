<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
    return view("welcome");
})->where('any', '.*');


Auth::routes(['register' => false]);

Route::get('register/{url}', 'Auth\RegisterController@showRegistrationForm')->name('regUrl')->where(['url' => '[a-z]+']);
Route::post('register/{url}', 'Auth\RegisterController@register')->where(['url' => '[a-z]+']);

