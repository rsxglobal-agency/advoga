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

class MessagesController extends Controller
{


	 public function __construct()
    {
        
        $this->middleware('auth');
        //['except' => ['getActivate', 'anotherMethod']
        
    }
    
    
    
    //rota 
 
    public function teste(){
        
        //Criar conversa
        $conversation = new Conversation();
        $conversation->from_user = 108;
        $conversation->to_user = 116;
        $conversation->demand_id = '89';
        $conversation->save();
    
        /*
        $message = new Message();
        $message->demand_id = '84';
        $message->from_user = '108';
        $message->to_user   = '116'; 
        $message->text      =  "Teste insert text";
        $message->save(); 
        $data = array();
       */
      
      
    }
    
    //Verifica se a conversa existe
    //Caso não exista, cria uma conversa com os parâmetros informados
    public function conversa(Request $request){
         

           $demand_id        = intval( $request->demand_id );
           $conversation_id  = intval( $request->conversation_id );
           $conversation     = null;
           
           //Para conversas que iniciam fora das areas de demandas
           if ($demand_id!=0){
              
                  $conversation = Conversation::where('demand_id',$request->demand_id)
                                    ->where(function ($query) use($request){
                                      $query->where('from_user', '=', $request->from_user)
                                      ->where('to_user', '=', $request->to_user)
                                      ->orWhere(function ($query) use($request){
                                       $query->where('from_user', '=',$request->to_user)
                                      ->where('to_user', '=',$request->from_user);
                                });      
                  })->get()->first(); 
           }
           
          
          //Para conversas que iniciam na área de busca por proficionais 
          if(($conversation_id==0) && ($demand_id==0)){
               
               if ($request->page=='busca'){

                   $conversation = Conversation::whereNull('demand_id')
                                    ->where(function ($query) use($request){

                                      $query->where('from_user','=',$request->from_user)
                                             ->where('to_user','=',$request->to_user);
                                  })->get()->first();  
                                 
                   if(!$conversation){
                      $conversation = Conversation::whereNull('demand_id')
                        ->where(function ($query) use($request){
                                  $query->where('to_user','=',$request->from_user)
                                  ->where('from_user','=',$request->to_user);
                        })->get()->first();  
                   }                
    
               } 
          }
          
           //Para conversas que iniciaram na área de busca por proficionais
           if ($conversation_id > 0){      
              $conversation = Conversation::find($conversation_id);
           }
            
              
            if(!$conversation){

                $conversation = new Conversation();
                $conversation->from_user = $request->from_user;
                $conversation->to_user   = $request->to_user;
                $conversation->demand_id = $request->demand_id;
                $conversation->save();

            } 
            
                              
             if ($conversation){
                
               $from_values = $conversation->from_user()->get()->pluck('name','image');
               $to_values   = $conversation->to_user()->get()->pluck('name','image');  

               $conversation->from_user()->get()->first();
                  foreach ($to_values as $image => $name){
                    $conversation['to'] = array('image'=>$image,'name'=>$name);  
               }
                
               foreach ($from_values as $image => $name){
                    $conversation['from'] = array('image'=>$image,'name'=>$name);  
               }
                  
             }

            return Response::json(array('success' => true,'data'=> $conversation ), 200);
            
    }
    
    
    public function insert(Request $request){
        
        
        $message = new Message();
        $message->conversation_id  = $request->conversation_id;
        $message->user_id          = $request->user_id;
        $message->special          = $request->special;
        $message->text             = $request->text;
       
       if($message->save()){
                 
            //$from_values = $message->from_user()->get()->pluck('name', 'image');
            //$to_values   = $message->to_user()->get()->pluck('name', 'image');  
            //foreach ($to_values as $image => $name){
            //    $message['to'] = array('image'=>$image,'name'=>$name);  
            //}
            
            //foreach ($from_values as $image => $name){
            //    $message['from'] = array('image'=>$image,'name'=>$name);  
            //}
            
            $user_values = $message->user()->get()->pluck('name', 'image');
            
            foreach ($user_values as $image => $name){
                
                if (empty($image)){
                    $image = "default.png";
                }
                
                $message['user'] = array('image'=>$image,'name'=>$name);  
            }

            //Verifica se é mensagem especial
            $special   = intval( $request->special );
            $damand_id = intval( $request->demand_id );
            
            //Usuário (candidato) é contratado
            if (($special==1) && ($damand_id!=0)){
               $demand = Demand::find($damand_id);
               $demand->executor_id = $request->to_user; 
               $demand->save();
               //$demand->candidatos()->detach($request->to_user);
            }
            
            //O contarato é cancelado
            if (($special==2) && ($damand_id!=0)){
                
                /*
               $count = DB::table('demand_executor')
                            ->where('executor_id',$request->to_user)
                            ->where('demand_id',$request->$damand_id)
                             ->count();
      
               $demand = Demand::find($damand_id);
               if ($count==0){
                 $demand->candidatos()->attach($request->to_user);
               }
               */
               $demand = Demand::find($damand_id);
               $demand->executor_id = NULL; 
               $demand->save();
            }
            

         return Response::json(array('success' => true,'data'=> $message ), 200);
         
       }else{
         return Response::json(array('success' => false,'data'=> null ), 200);
       }
        
       
    }
     
    public function json(Request $request){
        
         $messages = Message::where('conversation_id','=',$request->conversation_id)
                     ->orderBy('messages.id','ASC')
                     ->get();

          Message::where('conversation_id','=',$request->conversation_id)
          ->where("user_id","<>",Auth::user()->id)
          ->update(['viewed'=>1]);

        foreach($messages as $message){
            $user_values = $message->user()->get()->pluck('name', 'image');
            foreach ($user_values as $image => $name){
                $message['user'] = array('image'=>$image,'name'=>$name);  
            }   
        }
        
        return Response::json(array('data'=>$messages));
        
      
    }
  
}
