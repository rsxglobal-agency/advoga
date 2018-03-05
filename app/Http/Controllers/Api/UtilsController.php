<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use App\State;
use App\City;
use App\Utils;
use App\Atuation;
use App\Service;


use App\AppResult;

class UtilsController extends Controller
{
	public function getStates(Request $request){
		return json_encode(State::get());
	}

	public function getCities(Request $request){
		return json_encode(City::where('state_id', $request['state_id'])->get());
	}

	public function getAtuations(Request $request){
		return json_encode(Atuation::get());
	}

	public function getServices(Request $request){
		return json_encode(Service::get());
	}


}
