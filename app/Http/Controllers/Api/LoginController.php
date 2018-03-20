<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use Mail;
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
	public function loginUser(Request $request) {
		$auth = Auth::guard('web');

		if ($auth->attempt(['email' => strtolower($request['email']), 'password' => $request['password']  ]))
		{
			$user 	= $auth->user();
			$id 	= $auth->user()->id;

			$newApiToken = str_random(60);

			$rs = User::where('id', $auth->user()->id)
					->update(['remember_token' => $newApiToken]);

			//token api
			User::where('id', $auth->user()->id)
					->update(['api_token' => $newApiToken]);
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
			
			return json_encode(Array(
									'success' => true,
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
									'remember_token' => $newApiToken,
									));
	
		} else {
			return json_encode(Array(
				'success' => false,
				'msg' => 'Email e/ou Senha incorretos'
			));
		}
	}

	public function registerUser(Request $request) {
		$hasEmail = DB::select('SELECT email FROM users WHERE email=?', [$request['email']]);
		if ($hasEmail) {
			return json_encode(Array('success' => false, 'msg' => 'Email já cadastrado!'));
		}

		$user = new User();
		$user->name = $request['name'];
		$user->email = $request['email'];
		$user->password = Hash::make($request['password']);
		$user->state_id = $request['state_id'];
		$user->city_id = $request['city_id'];
		$user->titulation_id = $request['titulation_id'];
		$user->formation_id = $request['formation_id'];
		$user->image = '';
		$user->description = '';
		$user->social = '';
		$user->api_token = '';
		$user->active = 1;
		$resp = $user->save();
		if ($resp) {
			if ($request['image'] != '') {
				error_log('IMAGE: ');
				error_log($request['image']);
				Storage::disk('local')->put('uploads/avatars/foto_avatar_' . strval($user->id) . '.jpg', base64_decode($request['image']));
				DB::update('UPDATE users SET image=? WHERE id=?', ['foto_avatar_' . strval($user->id) . '.jpg', $user->id]);
			}
			return json_encode(Array('success' => true, 'msg' => 'Conta cadastrada com sucesso!'));
		} else {
			return json_encode(Array('success' => false, 'msg' => 'Não foi possível realizar o cadastro!'));
		}
	}

	public function passwordForgotten(Request $request) {
		$info = ((array)DB::select('SELECT id,email FROM users WHERE email=?', [$request['email']]));
		if (!empty($info) && !empty($info[0])) {
			$info = $info[0];
			$code    = str_random(4);
			
			Mail::raw('Código para resetar sua senha: ' . $code, function($message) use ($info) {
			   $message->to($info->email, 'Email')->subject
			      ('Recuperação de senha');
			   $message->from('advogaappteste@gmail.com','AdvogaApp');
			});

			if (!count(Mail::failures())) {
				DB::delete('DELETE FROM password_resets WHERE email=?', [$info->email]);
				$check = DB::insert('INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, ?)', [$info->email, $code, date('Y-m-d H:i', time())]);
				if ($check) {
					return json_encode(array('success' => true, 'msg' => 'O código foi enviado para o seu email'));
				} else {
					return json_encode(array('success' => false, 'msg' => 'Não foi possível gerar o seu código'));
				}
			} else {
				return json_encode(array('success' => false, 'msg' => 'Não foi possível enviar o email para ' . $info->email));
			}
		} else {
			return json_encode(array('success' => false, 'msg' => 'Email não cadastrado'));
		}
	}

	public function changePasswordForgotten(Request $request) {
		$code = $request['code'];
		$info = ((array)DB::select('SELECT pr.email as email,
								           pr.token as token,
								           pr.created_at as created_at,
								           u.id     as id
		                                 FROM password_resets as pr
		                                 	JOIN users as u on u.email = pr.email
		                                 WHERE token=?', [$code]));
		if (!empty($info) && !empty($info[0])) {
			$info = $info[0];
			$newPass = Hash::make($request['new_password']);
			$updateCheck = DB::update('UPDATE users SET password=? WHERE id=?', [$newPass, $info->id]);
			if ($updateCheck) {
				DB::delete('DELETE FROM password_resets WHERE email=?', [$info->email]);
				return json_encode(Array('success' => true, 'msg' => 'Sua senha foi atualizada'));
			} else {
				return json_encode(Array('success' => false, 'msg' => 'Não foi possível atualizar sua senha'));
			}
		} else {
			return json_encode(Array('success' => false, 'msg' => 'Código incorreto ou expirado'));
		}
	}


}
