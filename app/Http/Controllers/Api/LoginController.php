<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;
use Auth;
use App\AppResult;

class LoginController extends Controller
{
	public function loginUser(Request $request){
		$auth = Auth::guard('web');


		if ($auth->attempt(['email' => strtolower($request['email']), 'password' => $request['password']  ]))
		{
			$user = $auth->user();

			$newApiToken = str_random(60);

			$rs = App\User::where('id', $auth->user()->id)
					->update(['remember_token' => $newApiToken]);
			if(!$rs)
				return  AppResult::error('Erro ao gerar o token de autenticação', 100);


			return AppResult::result([
									'id' => $auth->id(),
									'remember_token' => $newApiToken
									]);
	
		} else {
			return AppResult::error('Email e/ou senha inválido(s)', 10);
		}

	}
}
