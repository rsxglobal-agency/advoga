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
use Intervention\Image\ImageManagerStatic as Image;
use App\AppResult;
require __DIR__.'/../../../../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../../../../advogaapp-firebase.json');

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    // The following line is optional if the project id in your credentials file
    // is identical to the subdomain of your Firebase project. If you need it,
    // make sure to replace the URL with the URL of your project.
    ->withDatabaseUri('https://advogaapp.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();
$storage = $firebase->getStorage();

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
			$img = $auth->user()->image;
			if (strpos($img, 'advogaapp.appspot.com') === false) {
				$filename = 'foto_avatar_' . $user->id . '.jpg';
				$fs = $storage->getFilesystem();
				$fs->put('avatars/' . $filename, file_get_contents('public/uploads/avatars/' . $filename));
				sleep(2);
				$user->image = $storage->getBucket()->object('avatars/' . $filename)->signedUrl(strtotime('01/01/2050'));
				$user->save();
			}
			
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
									'img' => $img,
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
			if (!empty($request['image64'])) {
				$filename = 'foto_avatar_' . $id . '.jpg';
				$filesystem = $storage->getFilesystem();
				$filesystem->put('avatars/' . $filename, base64_decode($request['image64']));
				DB::update('UPDATE users SET image=? WHERE id=?', [$storage->getBucket()->object('avatars/' . $filename)->signedUrl(strtotime('01/01/2050')), $id]);
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
