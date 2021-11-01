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


function hi($first, $last){
	return "Hi $first $last";
}
function getBracketsPosition($query){
	$counter = false;
	for ($i = 0; $i < mb_strlen($query); $i++) {
		$char = mb_substr($query, $i, 1);
		if($char == "("){
			$counter++;
			if($counter === false){
				$start = $i;
				$counter = 1;
			}
		}elseif($char == ")"){
			$counter--;
		}
		if($counter === 0){
			$end = $i;
			break;
		}
	}
	if($counter === false){
		return false;
	}
	return [$start, $end];
}
Route::get('/test', function (){
	$items = \App\Asterisk::distinct("linkedid");
	dd(groupBy("linkedid")->get()->toArray());
	$items = [
		1 => [
			"column" => "disposition",
			"operator" => "=",
			"value" => "ANSWERED",
		],
		2 => [
			"column" => "calldate",
			"operator" => ">",
			"value" => "2020-07-02 16:28:20",
		],
		3 => [
			"column" => "duration",
			"operator" => "<",
			"value" => "120",
		],
		4 => [
			"column" => "lastapp",
			"operator" => "=",
			"value" => "Dial",
		],
		5 => [
			"column" => "id",
			"operator" => ">",
			"value" => "15000",
		],
	];
	$query_str = "(1or(3and4or5))and2";
	$query = \App\Helpers\ParseHelper::makeQueryBuilder($items, $query_str);
	dd(\App\Asterisk::where($query)->get());

});
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/cron', 'CronController@start');
Route::get('/{any}', function () {
    return view("welcome");
})->where('any', '.*');


Auth::routes(['register' => false]);

Route::get('register/{url}', 'Auth\RegisterController@showRegistrationForm')->name('regUrl')->where(['url' => '[a-z]+']);
Route::post('register/{url}', 'Auth\RegisterController@register')->where(['url' => '[a-z]+']);

