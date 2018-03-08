<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use App\Utils;
use App\Demand;
use App\AppResult;
use App\User;
use App\City;

class ApplicationController extends Controller
{

	public static function myApplication(Request $request){

		$id = Utils::getIdUser($request->header('Authorization'));

	   	$demands = (array) DB::select("  
									select 
									u.id as id_user,
									u.name as user_name,
									u.image as avatar,
									u.total_rating as quantidade_de_notas,
									u.total_stars as nota_total,
									s.name as state_name,
									c.name as city_name,
									d.id as demanda_id,
									d.name as demand_name,
									d.description as description_demand
									from demand_executor as de
									join demands as d on d.id = de.demand_id
									join users as u on u.id=d.user_id
									join states as s on s.id=d.state_id
									join cities as c on c.id=d.city_id
									where de.executor_id='$id'
									and d.executor_id is null										
									");
	    $dados = array();
	     
		foreach ($demands as $demand){
			$dados['user_id'] = $demand->id_user;
			$dados['user_name'] = $demand->user_name;
			$dados['avatar'] = $demand->avatar;
			$dados['nota'] = $demand->nota_total / $demand->quantidade_de_notas;
			$dados['state_name'] = $demand->state_name;
			$dados['city_name'] = $demand->city_name;
			$dados['demand_id'] = $demand->demanda_id;
			$dados['demand_name'] = $demand->demand_name;
			$dados['description_demand'] = $demand->description_demand;		    
		    $services = Demand::find($demand->demanda_id)->services()->orderBy('name')->pluck('name')->toArray();
		    $services = implode (", ", $services);
		    $dados['services'] = $services;

		    $atuations = Demand::find($demand->demanda_id)->atuations()->orderBy('name')->pluck('name')->toArray();
		    $atuations = implode(", ", $atuations);
		    $dados['atuations'] = $atuations;
		  	$array[] = $dados;
		} 
    	return json_encode($array);
	}


}
