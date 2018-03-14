<?php
namespace App;

use Illuminate\Support\Facades\Session;
use Image;
use Auth;
use DB;
use App\User;
use App\Demand;

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


		$array = array();
		$dados = array();
		foreach ($resp as $value) {
			$dados['iduser'] = $value->iduser;
			$dados['nome'] = $value->nome;
			$dados['rating'] = $value->nota_total / $value->quantidade_de_notas;
			$dados['image'] = $value->image;
			$dados['formation'] = $value->formation;
			$dados['estado'] = $value->estado;
			$dados['cidade'] = $value->cidade;


			$array[] = $dados;	
		}
		return $array;

	}

	public static function getExecutorInfo($id) {
		$resp = (array) DB::select("SELECT id,name,image,total_stars,total_rating FROM users WHERE id='$id'");
		return $resp[0];
	}


	public static function getInfoUserFirebase($id){

		$firebase = "https://advogaapp.firebaseio.com/users/$id/dados.json";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $firebase,
		    CURLOPT_USERAGENT => 'Advoga-app'
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);
	}

	public static function getLatLongFirebase($id){

		$firebase = "https://advogaapp.firebaseio.com/users/$id/dados/geoAtual.json";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $firebase,
		    CURLOPT_USERAGENT => 'Advoga-app'
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);
	}

	public static function getExpTokenFirebase($id){

		$firebase = "https://advogaapp.firebaseio.com/users/$id/dados/expToken.json";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $firebase,
		    CURLOPT_USERAGENT => 'Advoga-app'
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);
	}

	public static function sendNotification($arrayInfo=NULL){
		$msg = array
		(
			'to' 	=> 	$arrayInfo['expToken'],
			'title'	=> $arrayInfo['titleNotification'],
			'sound'	=> "default",
			'body'	=> $arrayInfo['msg']

		);
		 
		$headers = array
		(
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://exp.host/--/api/v2/push/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $msg ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		return $result;
	}

}
