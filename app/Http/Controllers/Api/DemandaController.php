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

	// public function GetDemands(Request $request){
	// 	$id = Utils::getIdUser($request->header('Authorization'));
	// 	$resp = (array) DB::select("SELECT
	// 		d.id as id,
	// 		u.id as iduser,
	// 		u.name as nome,
	// 		d.id as demand_id,
	// 		d.name as titulodemanda,
	// 		d.description as descricaodemanda,
	// 		s.name as estado,
	// 		c.name as cidade,
	// 		d.created_at as data,
	// 		u.total_rating as quantidade_de_notas,
	// 		u.total_stars as nota_total,
	// 		u.image as image
	// 		FROM demands as d
	// 		join users as u ON u.id = d.user_id
	// 		join states as s on s.id = d.state_id
	// 		join cities as c on c.id = d.city_id
	// 		where d.user_id<>$id
	// 			and d.executor_id is null
	// 			and u.id not in (select executor_id from demand_executor as de where de.executor_id=$id)
	// 		order by d.created_at asc limit 40
	// 	");
	// 	$array = array();
	// 	$dados = array();
	// 	foreach ($resp as $value) {
	// 		$dados['id']				= $value->id;
	// 		$dados['image']				= $value->image;
	// 		$dados['nome']				= $value->nome;
	// 		$dados['iduser']			= $value->iduser;
	// 		$dados['rating']			= $value->nota_total / $value->quantidade_de_notas;
	// 		$dados['titulodemanda']		= $value->titulodemanda;
	// 		$dados['descricaodemanda']	= $value->descricaodemanda;
	// 		$dados['estado']			= $value->estado;
	// 		$dados['cidade']			= $value->cidade;
	// 		$dados['data']				= date("d-m-Y H:i", strtotime($value->data));
	// 		$dados['atuacao']			= Utils::getDemand($value->demand_id);
	// 		$dados['serv_prestado']		= Utils::getService($value->demand_id);
	// 		$array[] = $dados;
	// 	}
	// 	return json_encode($array);
	// }

	// public function GetDemandsLatLng(Request $request){
	public function GetDemands(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));
		if($request['lat'] && $request['long']){
			$lat = $request['lat'];
			$lng = $request['long'];
		}else{
			$user_city = User::select('city_id')->where('id',$id)->get()->first()->toArray();
			$name_city = City::select('name')->where('id',$user_city['city_id'])->get()->first()->toArray();
			$city = implode('+',explode(' ',$name_city['name']));
			$url_googleapis = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$city;
			$geocodeObject = json_decode(file_get_contents($url_googleapis), true);
			$lat = $geocodeObject['results'][0]['geometry']['location']['lat'];
			$lng = $geocodeObject['results'][0]['geometry']['location']['lng'];
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

		$cities = implode(', ',$whereCities);

		$resp = (array) DB::select("SELECT
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
				and c.name in ($cities)
				and d.executor_id is null
				and u.id not in (select executor_id from demand_executor as de where de.executor_id=$id)
			order by d.created_at asc limit 40
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
		json_encode(array('msg'=>'ok'));

		//$resp = (array) DB::select(" UPDATE demands SET executor_id='$id' WHERE id='$id_demanda' AND executor_id IS NULL ");

	}

}
