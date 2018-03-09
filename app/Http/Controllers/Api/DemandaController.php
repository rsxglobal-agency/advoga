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

		$resp = (array) DB::select("
		SELECT
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
				and u.id not in (select executor_id from demand_executor as de where de.executor_id=$id)
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
		$resp = Auth::user()->candidatos()->attach($request['id']);
		return json_encode(array('msg'=>'candidatura aceita, aguarde para aprovação!'));

	}

	public static function sendDemand(Request $request){
		$user_id = Utils::getIdUser($request->header('Authorization'));
	    
	    $demand = new Demand;
		
		$demand->name = $request['name'];
		$demand->description= $request['description'];
		$demand->state_id = $request['state_id'];
		$demand->city_id = $request['city_id'];
		$demand->atuations = $request['atuations'];
		$demand->services = $request['services'];
		$demand->user_id = $user_id;
		$demand->ended = false;

		if ($demand->save()) {
			return json_encode(Array('success' => true));
		}

		return json_encode(Array('success' => false));

	}

	public static function myDemands(Request $request)
	{
		$id = Utils::getIdUser($request->header('Authorization'));

       $demands = Demand::where('user_id',$id)->orderby('created_at', 'desc')->get();

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

	public static function demandsOnExecution(Request $request){
		$id 		= Utils::getIdUser($request->header('Authorization'));
		$demands 	= (array) DB::select(" select * from demands where user_id='$id' 
											and executor_id is not null
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
		}

		return json_encode($data);


	}



}
