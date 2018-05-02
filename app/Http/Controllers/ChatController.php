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

require __DIR__.'/../../../../vendor/autoload.php';

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
      
      
      $conversations  = Conversation::where(function($query){
                            $query->where('from_user',Auth()->user()->id);    
                            $query->orWhere('to_user',Auth()->user()->id);  
                        })->orderby("created_at", "DESC")->get();
      
      foreach($conversations as $conversation){
             
              
              if ($conversation->from_user==Auth()->user()->id){
                 $other_user_id = $conversation->to_user;
              }
              
              if ($conversation->to_user==Auth()->user()->id){
                 $other_user_id = $conversation->from_user;
              }
              
             $conversation['other'] = User::where('id',$other_user_id)->select('id','name','image')->get()->first();
             
      
             /*
               $from_values = $conversation->from_user()->get()->pluck('name','image');
               $to_values   = $conversation->to_user()->get()->pluck('name','image');  

               $conversation->from_user()->get()->first();
                  foreach ($to_values as $image => $name){
                    $conversation['to'] = array('image'=>$image,'name'=>$name);  
               }
                
               foreach ($from_values as $image => $name){
                    $conversation['from'] = array('image'=>$image,'name'=>$name);  
               }
            */ 
      }
      
      $data['conversations'] = $conversations;
    
      
      return view("chat.index",$data);
    }

  
}
