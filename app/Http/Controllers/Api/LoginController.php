<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use App\State;
use App\City;
use App\User;
use App\Atuation;
use App\Service;


use App\AppResult;

class LoginController extends Controller
{
	public function loginUser(Request $request){
		$auth = Auth::guard('web');


		if ($auth->attempt(['email' => strtolower($request['email']), 'password' => $request['password']  ]))
		{
			$user 	= $auth->user();
			$id 	= $auth->user()->id;

			$newApiToken = str_random(60);

			$rs = User::where('id', $auth->user()->id)
					->update(['remember_token' => $newApiToken]);
			if(!$rs)
				return  AppResult::error('Erro ao gerar o token de autenticação', 100);


			$estado = State::where('id',$auth->user()->state_id)->first();
			$cidade = State::leftjoin('cities as c', 'states.id', '=', 'c.state_id')
							->where('c.id',$auth->user()->city_id)->first();

			// $estado_id = $auth->user()->state_id;
			// $teste = DB::select( DB::raw("SELECT sigla FROM states WHERE id='$estado_id'"));

			$id_titulacao = $auth->user()->titulation_id;
			$titulacao = DB::select( DB::raw("SELECT name FROM titulations WHERE id='$id_titulacao'"));
			

			$id_formacao = $auth->user()->formation_id;
			$formacao = DB::select( DB::raw("SELECT name FROM formations WHERE id='$id_formacao'"));

			$atuacao = Atuation::select(
									'name'
									)
							->leftJoin('atuation_user as au', 'id', '=', 'au.atuation_id')
							->where('au.user_id',$auth->user()->id)->get()->toArray();

			$servicosprestados = Service::select(
									'name'
									)
							->leftJoin('service_user as su', 'id', '=', 'su.service_id')
							->where('su.user_id',$auth->user()->id)->get()->toArray();

			$quantidade_de_notas = $auth->user()->total_rating;
			$nota_total = $auth->user()->total_stars;
			$nota = $nota_total / $quantidade_de_notas;

			// $img = '';
			// $imageName = "foto_avatar_". $auth->user()->id;
			// if (file_exists($photopath . $imageName . ".jpg")){
			// 	$img = base64_encode(file_get_contents($photopath . $imageName . ".jpg"));
			// }


			return AppResult::result([
									'id' => $auth->id(),
									'nome'=> $auth->user()->name,
									'email'=> $auth->user()->email,
									'descricao'=> $auth->user()->description,
									'estado' => $estado->name,
									'cidade' => $cidade->name,
									'descricao' => $auth->user()->descricao,
									'social' => $auth->user()->social,
									'titulacao' => $titulacao,
									'formacao' => $formacao,
									'atuacao' => $atuacao,
									'servicosprestados' => $servicosprestados,
									'nota' => $nota,
									'img' => $auth->user()->image,
									'remember_token' => $newApiToken
									]);


				// $post['USUARIO'][] = array(
				// 	'id' => "$id",
				// 	'nome' => "$nome",
				// 	'email' => "$email",
				// 	'estado' => "$estado",
				// 	'cidade' => "$cidade",
				// 	'descricao' => "$descricao",
				// 	'social' => "$social",
				// 	'titulacao' => "$titulacao",
				// 	'formacao' => "$formacao",
				// 	'id_aa' => "$id_areasdeatuacao",
				// 	'id_sp' => "$id_servicosprestados",
				// 	'areasdeatuacao' => "$aa",
				// 	'servicosprestados' => "$sp",
				// 	'nota' => "$nota",
				// 	'img' => "$img",
				// 	'token'=> $token
				// );

				// echo json_encode($post);


	
		} else {
			return AppResult::error('Email e/ou senha inválido(s)', 10);
		}

	}
}
