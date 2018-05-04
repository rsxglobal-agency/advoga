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
      // The following line is optional if the project id in your credentials file
      // is identical to the subdomain of your Firebase project. If you need it,
      // make sure to replace the URL with the URL of your project.
      ->withDatabaseUri('https://advogaapp.firebaseio.com/')
      ->create();

      $database = $firebase->getDatabase();

      $selectUsuarios = $database->getReference('chat/users/'.$user->id);
      $usuariosChat = $selectUsuarios->getValue();

      $demand_ids = [];
      foreach ($usuariosChat as $key => $value) {
        $demand_ids[] = $key.',';

        //pegando usuario que vai a msg
        foreach ($value as $key2 => $value2) {
          $idusuarioDestinatario = $value2['user_to'];
          $selectUsuariosDest = $database->getReference('users/'.$idusuarioDestinatario.'/dados');
          $usuariosChatDest = $selectUsuariosDest->getValue();

          $usuarioDestinatario = $usuariosChatDest['nome'];
        }
      }
      
      
      $idAssunto = substr($demand_ids[0],0,-1);

      $demand_name = DB::select('SELECT name FROM demands WHERE id IN(?)', [$idAssunto]);

      return view("chat.index",['demand_name' => $demand_name, 'usuarioDestinatario' => $usuarioDestinatario]);
    }

  
}