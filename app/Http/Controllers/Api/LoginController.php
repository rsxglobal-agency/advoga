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
use App\Formation;
use App\Titulation;


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

			$titulacao = Titulation::select('name')->where('id',$auth->user()->titulation_id)->first();

			$formacao = Formation::select('name')->where('id',$auth->user()->formation_id)->first();
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

			return AppResult::result([
									'id' => $auth->id(),
									'nome'=> $auth->user()->name,
									'email'=> $auth->user()->email,
									'descricao'=> $auth->user()->description,
									'estado' => $estado->name,
									'cidade' => $cidade->name,
									'descricao' => $auth->user()->descricao,
									'social' => $auth->user()->social,
									'titulacao' => $titulacao['name'],
									'formacao' => $formacao['name'],
									'atuacao' => $atuacao,
									'servicosprestados' => $servicosprestados,
									'nota' => $nota,
									'img' => $auth->user()->image,
									'remember_token' => $newApiToken
									]);
	
		} else {
			return AppResult::error('Email e/ou senha inválido(s)', 10);
		}

	}
}
