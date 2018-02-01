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
	Route::get('/feed-demandas/', 'Api\DemandaController@GetDemandas');
});


Route::get('/login', function () {
    return redirect('api');
});

Route::get('/login', 'Api\LoginController@loginUser')->middleware('throttle:20,1');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
