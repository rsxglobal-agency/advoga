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
use App\Formation;
use App\Titulation;
use App\Demand;


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

	public function getFormations(Request $request) {
		return json_encode(Formation::get());
	}

	public function getTitulations(Request $request) {
		return json_encode(Titulation::get());
	}

	public function historic(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));
        $demands = (array) DB::select(" 
	        				SELECT * FROM `demands` 
	        				WHERE `ended` = 1 
	        				ORDER BY `created_at` DESC
        				");
       
        $data = array();
        
        foreach ($demands as $demand){
            
            $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
            $services = implode (", ", $services);
            $demand->services = $services;

            $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
            $atuations = implode(", ", $atuations);
            $demand->atuations = $atuations;

            $data[]  = $demand;
        } 
        return json_encode($data);

	}


}
