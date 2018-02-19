<?php
namespace App;

use Illuminate\Support\Facades\Session;
use Image;
use Auth;
use DB;
use App\User;

class Utils
{

	public static function getIdUser($info){
		$token = explode(' ',$info);

		$user = User::select('id')->where('api_token',$token[1])->get()->first()->toArray();
		return $user['id'];

	}
	public static function getDemand($ids){
		print_r($ids);
		die('fim');
	}


}
