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


use App\AppResult;

class DemandaController extends Controller
{
	public function GetDemandas(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));

		$resp = (array) DB::select("SELECT * FROM demands as d
									join users as u ON u.id = d.user_id
									join states as s on s.id = d.state_id
									join cities as c on c.id = d.city_id
									where d.user_id<>'351'
									and d.executor_id is null
									and u.id not in (select executor_id from demand_executor as de where de.executor_id='351') ");
		return json_encode($resp);

	}
}
