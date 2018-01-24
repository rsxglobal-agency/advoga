<?php

namespace App\Http\Controllers;


use App\User;
use App\Conversation;
use Auth;
use Requests;
use App\Demand;
use App\Message;

class StatusController extends Controller
{
    public function status() {

      $messages = Message::whereHas("conversation",function($query){
         $query-> where('to_user', Auth::user()->id);
      })->with("user")->where("viewed", 0)->where("user_id","<>", Auth::user()->id)->get();
      
      return ["messages"=>$messages, "chat_counter"=>$messages->count()];

    }

    public function executor() {

    	$demands = Demand::where('user_id', Auth::user()->id)->whereHas("candidatos", function($query){
    		$query->where('viewed', 0);
    	})->with("candidatos")->get();

    	return ["demands"=>$demands, "demand_counter"=>$demands->count()];

    }
 
}