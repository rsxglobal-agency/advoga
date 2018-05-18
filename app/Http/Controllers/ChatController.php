<?php

namespace App\Http\Controllers;


use App\User;
use App\Message;
use App\Demand;
use App\Conversation;
use Auth;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../../../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ChatController extends Controller
{


	public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
      $user = Auth::user();
      
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../../../advogaapp-firebase.json');

      $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
      ->withDatabaseUri('https://advogaapp.firebaseio.com/')
      ->create();

      $database = $firebase->getDatabase();

      $selectUsuarios   =   $database ->        getReference('chat/users/'.$user->id);
      $usuariosChat     =   $selectUsuarios ->  getValue();
      if($usuariosChat != null)
      {
        $keys           =   array_keys($usuariosChat);
        foreach($keys as $key)
        {
          $valueA   =   array_keys($usuariosChat[$key]);
          foreach($valueA as $contA)
          {
            $msg_id = $usuariosChat[$key][$contA]["messages_key"];
            $msg_to = $usuariosChat[$key][$contA]["user_to"];
            $selectUsrTo =$database->getReference("users/".$msg_to."/dados")->getValue();
            $usuarioDestinatario = $selectUsrTo;
            
            $var[] = DB::select('SELECT name FROM demands WHERE id IN(?)', [$key]);
          }
         
        }
        $demand_name = $var;

        return view("chat.index",['demand_name' => $demand_name, 'usuarioDestinatario' => $usuarioDestinatario, 'id' => $keys]);
      }
      else{
        return view("chat.index",['demand_name' => [], 'usuarioDestinatario' => '']);
      }
    }

  
}