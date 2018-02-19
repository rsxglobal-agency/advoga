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

		$resp = (array) DB::select("SELECT d.id as id,
											u.id as iduser,
											u.name as nome,
											d.name as titulodemanda,
											d.description as descricaodemanda,
											s.name as estado,
											c.name as cidade,
											d.created_at as data,
											u.total_rating as total,
											u.total_stars as totalStars,
											u.image as image											
											 FROM demands as d
									join users as u ON u.id = d.user_id
									join states as s on s.id = d.state_id
									join cities as c on c.id = d.city_id
									where d.user_id<>$id
									and d.executor_id is null
									and u.id not in (select executor_id from demand_executor as de where de.executor_id=$id) order by d.created_at asc limit 40 ");
		$array = array();
		$dados = array();

		foreach ($resp as $value) {

		$dados['id'] 				= $value->id;
		$dados['image'] 			= $value->image;
		$dados['iduser']			= $value->iduser;
		$dados['nome']				= $value->nome;
		$dados['rating']			= $value->total / $value->totalStars ;
		$dados['titulodemanda']		= $value->titulodemanda;
		$dados['descricaodemanda']	= $value->descricaodemanda;
		$dados['estado']			= $value->estado;
		$dados['cidade']			= $value->cidade;
		$dados['data']				= date("d-m-Y H:i", strtotime($value->data));


			$array[] = $dados;
		}



		return json_encode($array);

	}
}
