<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App;
use DB;
use Auth;
use App\User;
use App\State;
use App\City;
use App\Utils;
use App\Atuation;
use App\Service;
use App\Formation;
use App\Titulation;
use App\Demand;
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


class UtilsController extends Controller
{
	public function getStates(Request $request){
		return json_encode(State::get());
	}

	public function getCities(Request $request){
		return json_encode(City::where('state_id', $request['state_id'])->get());
	}

	public function getAtuations(Request $request){
		return json_encode(Atuation::get());
	}

	public function getServices(Request $request){
		return json_encode(Service::get());
	}

	public function getFormations(Request $request) {
		return json_encode(Formation::get());
	}

	public function getTitulations(Request $request) {
		return json_encode(Titulation::get());
	}

	public function historic(Request $request){
		$id = Utils::getIdUser($request->header('Authorization'));
        $demands = (array) DB::select(" 
							SELECT
								d.id as id,
								d.name as name,
								d.description as description,
								d.ended as ended,
								u.id as user_id,
								e.id as executor_id,
								u.name as user_name,
								e.name as executor_name,
								u.image as user_img,
								e.image as executor_img,
								u.rate as user_rate,
								e.rate as executor_rate,
								s.id as state_id,
								s.name as state_name,
								c.id as city_id,
								c.name as city_name
							FROM demands as d
								JOIN states as s on s.id = d.state_id
								JOIN cities as c on c.id = d.city_id
								JOIN users as u on u.id = d.user_id
								JOIN users as e on e.id = d.executor_id
							WHERE d.ended = 1 AND (d.user_id = '$id' OR d.executor_id = '$id')
							ORDER BY d.created_at DESC
        				");
       
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

	public function userInfo(Request $request) {
		$id = Utils::getIdUser($request->header('Authorization'));
		$user = DB::select('SELECT * FROM users WHERE id=?', [$id]);
		return json_encode($user);
	}

	public function editProfile(Request $request) {
		$id = Utils::getIdUser($request->header('Authorization'));
		$user = new User();
		$user->name = $request['name'];
		$user->email = $request['email'];
		$user->state_id = $request['state_id'];
		$user->city_id = $request['city_id'];
		$user->titulation_id = $request['titulation_id'];
		$user->formation_id = $request['formation_id'];
		$user->active = 1;
		$resp = $user->where('id', '=', $id)->update($user->toArray());
		if ($resp) {
			if (!empty($request['image64'])) {
				$filename = 'foto_avatar_' . $id . '.jpg';
				$filesystem = $storage->getFilesystem();
				$filesystem->put('avatars/' . $filename, base64_decode($request['image64']));
				DB::update('UPDATE users SET image=? WHERE id=?', [$storage->getBucket()->object('avatars/' . $filename)->signedUrl(strtotime('01/01/2050')), $id]);
			}
			return json_encode(Array('success' => true, 'msg' => 'Perfil editado com sucesso'));
		} else {
			return json_encode(Array('success' => false, 'msg' => 'Não foi possível editar o seu perfil'));
		}
	}


	public function sendPushNotification(Request $request) {
		$id = Utils::getIdUser($request->header('Authorization'));
		$notification = Array(
			'expToken' => $request['expToken'],
			'titleNotification' => $request['title'],
			'msg' => $request['msg'],
			'data' => $request['data'],
		);
		if (Utils::sendNotification($notification)) {
			return json_encode(Array('success' => true));
		}
		return json_encode(Array('success' => false));
	}
}
