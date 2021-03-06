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

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('/user-info', 'Api\UtilsController@userInfo');
	Route::get('/feed-demandas/', 'Api\DemandaController@GetDemands');
	Route::post('/edit-profile/', 'Api\UtilsController@editProfile');
	Route::post('/accept-demand/', 'Api\DemandaController@acceptDemand');
	Route::post('/send-demand/', 'Api\DemandaController@sendDemand');
	Route::post('/edit-demand/', 'Api\DemandaController@editDemand');
	Route::post('/delete-demand/', 'Api\DemandaController@deleteDemand');
	Route::post('/cancel-demand/', 'Api\DemandaController@cancelDemand');
	Route::post('/conclude-demand/', 'Api\DemandaController@concludeDemand');
	Route::post('/delete-candidate/', 'Api\DemandaController@deleteCandidate');
	Route::post('/accept-candidate/', 'Api\DemandaController@acceptCandidate');
	//minhas demandas
	Route::get('/my-demands/', 'Api\DemandaController@myDemands');
	Route::get('/demands-on-execution/', 'Api\DemandaController@demandsOnExecution');
	Route::get('/demand-name/', 'Api\DemandaController@demandName');
	//Candidaturas
	Route::get('/my-application/', 'Api\ApplicationController@myApplication');
	Route::get('/my-executions/', 'Api\ApplicationController@myExecutions');
	Route::get('/historic/', 'Api\UtilsController@historic');
	Route::post('/cancel-application/', 'Api\ApplicationController@cancelApplication');
});

Route::get('/login', 'Api\LoginController@loginUser');

Route::post('/register-user/', 'Api\LoginController@registerUser');
Route::post('/password-forgotten/', 'Api\LoginController@passwordForgotten');
Route::post('/change-password-forgotten/', 'Api\LoginController@changePasswordForgotten');
Route::post('/send-push-notification/', 'Api\UtilsController@sendPushNotification');
Route::get('/utils-states/', 'Api\UtilsController@getStates');
Route::get('/utils-cities/', 'Api\UtilsController@getCities');
Route::get('/utils-atuations/', 'Api\UtilsController@getAtuations');
Route::get('/utils-services/', 'Api\UtilsController@getServices');
Route::get('/utils-formations/', 'Api\UtilsController@getFormations');
Route::get('/utils-titulations/', 'Api\UtilsController@getTitulations');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
