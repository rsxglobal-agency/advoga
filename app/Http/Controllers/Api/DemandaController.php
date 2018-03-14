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

class DemandaController extends Controller
{

	private function getCoords($city){
		$url_googleapis = 'https://maps.googleapis.com/maps/api/geocode/json?address='.implode('+',explode(' ',$city));
		$geocodeObject = json_decode(file_get_contents($url_googleapis), true);
		if(isset($geocodeObject['results'][0])){
			return $geocodeObject['results'][0]['geometry']['location'];
		}else{
			return $this->getCoords($city);
		}
	}

	public function GetDemands(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));
		$user_city = User::select('city_id')->where('id',$id)->get()->first()->toArray();
		$name_city = City::select('name')->where('id',$user_city['city_id'])->get()->first()->toArray();

		if($request['lat'] && $request['long']){
			$lat = $request['lat'];
			$lng = $request['long'];
		}else{
			$coords = $this->getCoords($name_city['name']);
			$lat = $coords['lat'];
			$lng = $coords['lng'];
		}

		$responseStyle = 'short';
		$citySize = 'cities15000';
		$radius = 25;
		$maxRows = 30;
		$username = 'christian_rsxglobal';
		$url_geonames = 'http://api.geonames.org/findNearbyPlaceNameJSON?lat='.$lat.
			'&lng='.$lng.'&style='.$responseStyle.'&cities='.$citySize.
			'&radius='.$radius.'&maxRows='.$maxRows.'&username='.$username;
		$nearbyCities = json_decode(file_get_contents($url_geonames, true));
		$whereCities = [];
		foreach ($nearbyCities->geonames as $key => $citie) {
			$whereCities[] = "'$citie->name'";
		}
		$n = $name_city['name'];
		$c = $whereCities ? implode(', ',$whereCities) : "'$n'";

        $arrayId=Auth::user()->candidatos->pluck('id');
		$arrayIds = [];
		foreach ($arrayId as $key => $value) {
			$arrayIds[] = "'$value'";
		}
		$i = $arrayIds ? implode(', ',$arrayIds) : "'$id'";

		// DB::enableQueryLog();
		$resp = (array) DB::select("
		select	
			d.id as id,
			u.id as iduser,
			u.name as nome,
			d.id as demand_id,
			d.name as titulodemanda,
			d.description as descricaodemanda,
			s.name as estado,
			c.name as cidade,
			d.created_at as data,
			u.total_rating as quantidade_de_notas,
			u.total_stars as nota_total,
			u.image as image
			FROM demands as d
			join users as u ON u.id = d.user_id
			join states as s on s.id = d.state_id
			join cities as c on c.id = d.city_id
			where d.user_id<>$id
				and c.name in ($c)
				and d.executor_id is null
				and d.id not in ($i)
			order by d.created_at desc limit 40
		");
		$array = array();
		$dados = array();

		foreach ($resp as $value) {

			$dados['id']				= $value->id;
			$dados['image']				= $value->image;
			$dados['nome']				= $value->nome;
			$dados['iduser']			= $value->iduser;
			$dados['rating']			= $value->nota_total / $value->quantidade_de_notas;
			$dados['titulodemanda']		= $value->titulodemanda;
			$dados['descricaodemanda']	= $value->descricaodemanda;
			$dados['estado']			= $value->estado;
			$dados['cidade']			= $value->cidade;
			$dados['data']				= date("d-m-Y H:i", strtotime($value->data));
			$dados['atuacao']			= Utils::getDemand($value->demand_id);
			$dados['serv_prestado']		= Utils::getService($value->demand_id);

			$array[] = $dados;
		}
		return json_encode($array);
	}


	public function acceptDemand(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));
		$demand = new demand();
		$property_demand = $demand->where('id',$request['demand_id'])->first();
		if($property_demand!=NULL){
			//Auth::user()->candidatos()->attach($request['demand_id']);

			$expToken 	= Utils::getExpTokenFirebase($property_demand->user_id);
			$info 		= Utils::getInfoUserFirebase($id);

			$arrayInfo = array
			(
				'expToken' 	=> 	$expToken,
				'titleNotification'	=> "Parabéns pelo novo candidato!",
				'msg'	=> "O candidato ".$info->nome." se candidatou para o ticket #".$request['demand_id']

			);
			$respNoti = Utils::sendNotification($arrayInfo);
			print_r($respNoti);
			die();
			return json_encode(array('msg'=>'candidatura aceita, aguarde para aprovação!'));
		}else{
			return json_encode(array('msg'=>'Erro ao se candidatar, essa demanda ja foi concluída!'));
		}
	}

	public function cancelDemand(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));

		$demand = new Demand();
		$demand->executor_id = null; 
		$resp = $demand->where('id', '=', $request['demand_id'])->update($demand->toArray());
		if ($resp) {
			return json_encode(array('msg'=>'Cancelado com sucesso!'));
		}
		else{
			return json_encode(array('msg'=>'erro ao cancelar!'));
		}	
	}

	public function concludeDemand(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));

		$demand = new Demand();
		$demand->conclude1 = true; 
		$demand->conclude2 = true; 
		$resp = $demand->where('id', '=', $request['demand_id'])->update($demand->toArray());
		if ($resp) {
			return json_encode(array('msg'=>'Demanda finalizada com sucesso!'));
		}
		else{
			return json_encode(array('msg'=>'erro ao concluir!'));
		}	
	}


	public static function sendDemand(Request $request){
		$user_id = Utils::getIdUser($request->header('Authorization'));

		$demand = new Demand;

		$demand->name = $request['name'];
		$demand->description= $request['description'];
		$demand->state_id = $request['state_id'];
		$demand->city_id = $request['city_id'];	
		$demand->user_id = $user_id;
		$demand->ended = 0;
		$resp = $demand->save();

		if ($resp) {
			foreach ($request['atuations'] as $value) {
				DB::insert('insert into atuation_demand (atuation_id, demand_id) values(?, ?)', [$value, $demand->id]);
			}
			foreach ($request['services'] as $value) {
				DB::insert('insert into demand_service (service_id, demand_id) values(?, ?)', [$value, $demand->id]);
			}
			return json_encode(Array('success' => true));
		}

		return json_encode(Array('success' => false));
	}

	public static function editDemand(Request $request) {
		$user_id = Utils::getIdUser($request->header('Authorization'));
		$demand = New Demand;
		$demand->name = $request['name'];
		$demand->description= $request['description'];
		$demand->state_id = $request['state_id'];
		$demand->city_id = $request['city_id'];
		$demand->atuations = $request['atuations'];
		$demand->services = $request['services'];
		$demand->user_id = $user_id;
		$demand->where('id',$request['id'])->update($demand->toArray());
		return json_encode($var);

	}

	public static function myDemands(Request $request)
	{

		$id = Utils::getIdUser($request->header('Authorization'));

		$demands = (array) DB::select("
						SELECT
							d.id as id,
							d.name as name,
							d.description as description,
							d.ended as ended,
							d.executor_id as executor_id,
							s.name as state_name,
							s.id as state_id,
							c.name as city_name,
							c.id as city_id
						FROM demands as d
							join states as s on s.id = d.state_id
							join cities as c on c.id = d.city_id
						WHERE d.user_id='$id' AND d.executor_id IS NULL
						ORDER BY d.created_at DESC");


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

		    $demand->candidatos =  Utils::getCandidates($demand->id);

		    $data[]  = $demand;
		}

		return json_encode($data);
	}

	public static function demandsOnExecution(Request $request){
		$id 		= Utils::getIdUser($request->header('Authorization'));
		$demands 	= (array) DB::select("
						SELECT
							d.id as id,
							d.name as name,
							d.description as description,
							d.ended as ended,
							d.executor_id as executor_id,
							s.name as state_name,
							c.name as city_name
						FROM demands as d
							join states as s on s.id = d.state_id
							join cities as c on c.id = d.city_id
						WHERE d.user_id='$id' 
						AND d.executor_id is not null 
						AND d.conclude1 is null  
						");

		$data['demands'] = array();

		foreach ($demands as $demand){
		    
		    $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
		    $services = implode (", ", $services);
		    $demand->services = $services;

		    $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
		    $atuations = implode(", ", $atuations);
		    $demand->atuations = $atuations;
		    $data['demands'][]  = $demand;

		    if (!isset($data['executors'][$demand->executor_id])) {
		    	$resp = Utils::getExecutorInfo($demand->executor_id);
		    	$data['executors'][$demand->executor_id]['id'] = $resp->id;
		    	$data['executors'][$demand->executor_id]['name'] = $resp->name;
		    	$data['executors'][$demand->executor_id]['image'] = $resp->image;
		    	$data['executors'][$demand->executor_id]['rating'] = $resp->total_stars / $resp->total_rating;
		    }
		}

		return json_encode($data);
	}

	public static function demandName(Request $request) {
		$demandIds = implode(', ', $request->ids);
		$demands = DB::select('SELECT name FROM demands WHERE id IN (' . $demandIds . ')');
		return json_encode($demands);
	}


}
