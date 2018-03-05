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

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('/feed-demandas/', 'Api\DemandaController@GetDemands');
	Route::post('/accept-demand/', 'Api\DemandaController@acceptDemand');
});

Route::get('/utils-states/', 'Api\UtilsController@getStates');
Route::get('/utils-cities/{state_id}', 'Api\UtilsController@getCities');
Route::get('/utils-atuations/', 'Api\UtilsController@getAtuations');
Route::get('/utils-services/', 'Api\UtilsController@getServices');

Route::get('/terms/', 'Api\UtilsController@getTerms');

Route::get('/login', function () {
    return redirect('api');
});

Route::get('/login', 'Api\LoginController@loginUser')->middleware('throttle:20,1');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
