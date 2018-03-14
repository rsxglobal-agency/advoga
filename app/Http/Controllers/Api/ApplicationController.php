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
									order by d.id desc										
									");
	    $array = array();
	     

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

	public static function myExecutions(Request $request){

		$id = Utils::getIdUser($request->header('Authorization'));

		$demands = (array) DB::select("  
								SELECT
									d.id as id,
									d.name as name,
									u.id as user_id,
									u.rate as user_rate,
									e.id as executor_id,
									s.id as state_id,
									s.name as state_name,
									c.id as city_id,
									c.name as city_name
								FROM demands as d
									JOIN users as u on u.id = d.user_id
									JOIN users as e on e.id = d.executor_id
									JOIN states as s on s.id = d.state_id
									JOIN cities as c on c.id = d.city_id
								WHERE executor_id='$id' ORDER BY created_at DESC
								");
		$data = array();
		 
		 foreach ($demands as $demand){
		        
		        $services = Demand::find($demand->id)->services()->orderBy('id')->pluck('name')->toArray();
		        $services_ids = Demand::find($demand->id)->services()->orderBy('id')->pluck('id')->toArray();
		        $services = implode (", ", $services);
		        $demand->services = $services;
		        $demand->services_ids = $services_ids;

		        $atuations = Demand::find($demand->id)->atuations()->orderBy('id')->pluck('name')->toArray();
		        $atuations_ids = Demand::find($demand->id)->atuations()->orderBy('id')->pluck('id')->toArray();
		        $atuations = implode(", ", $atuations);
		        $demand->atuations = $atuations;
		        $demand->atuations_ids = $atuations_ids;

		        $data[]  = $demand;

		} 
		return json_encode($data);
	}

	public static function cancelApplication(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));

		$resp = DB::table('demand_executor')
					->where('executor_id', '=', $id)
					->where('demand_id', '=', $request['demand_id'])
					->delete();
		if($resp){
			return json_encode(array('msg'=> 'Candidatura removida com sucesso!'));	
		}else{
			return json_encode(array('msg'=> 'Erro ao remover sua candidatura!'));	
		}

		

	}

}
