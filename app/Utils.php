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


}
