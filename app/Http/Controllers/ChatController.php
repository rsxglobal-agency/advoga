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
      
      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/../../../advogaapp-firebase.json');

          $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            // The following line is optional if the project id in your credentials file
            // is identical to the subdomain of your Firebase project. If you need it,
            // make sure to replace the URL with the URL of your project.
            ->withDatabaseUri('https://advogaapp.firebaseio.com/')
            ->create();

            $database = $firebase->getDatabase();

            $selectUsuarios = $database->getReference('chat/users')
            ->orderByChild(6669)
            ->getSnapshot();

            $usuariosChat = $selectUsuarios->getValue();
            print_r($usuariosChat);
            die;

      
      
    
      
      //return view("chat.index",['usuariosChat' => $usuariosChat]);
            return view("chat.index",$usuariosChat);
    }

  
}
