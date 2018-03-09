<?php
namespace App;

use Illuminate\Support\Facades\Session;
use Image;
use Auth;
use DB;
use App\User;

class Utils
{

	public static function getIdUser($info){
		$token = explode(' ',$info);

		$user = User::select('id')->where('api_token',$token[1])->get()->first()->toArray();
		return $user['id'];

	}
	public static function getDemand($id){
		$resp = (array) DB::select("SELECT a.name FROM atuation_demand as ad 
									join atuations as a on a.id=ad.atuation_id
									WHERE ad.demand_id='$id'
									");

		return $resp;
	}

	public static function getService($id){
		$resp = (array) DB::select("SELECT s.name FROM demand_service as ds
									join services as s on ds.service_id=s.id
									WHERE ds.demand_id='$id'
									");

		return $resp;
	}

	public static function getCandidates($id){

		$resp = (array) DB::select("
									SELECT 
										u.id as iduser,
										u.name as nome,
										u.total_rating as quantidade_de_notas,
										u.total_stars as nota_total,
										u.image as image,
										f.name as formation,
										s.name as estado,
										c.name as cidade
									FROM demand_executor as de
										join users as u on u.id = de.executor_id
										join states as s on s.id = u.state_id
										join cities as c on c.id = u.city_id
										join formations as f on f.id=u.formation_id
									WHERE de.demand_id='$id'
									");

		return $resp;

	}

}
