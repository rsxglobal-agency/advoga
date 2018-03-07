<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Demand;

class DiligenciaController extends Controller
{
   public function index(){

       	$demands  = Auth::user()->demandExecutors;
          
        $data['demands'] = array();
         
         foreach ($demands as $demand){
                
                $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
                $services = implode (", ", $services);
                $demand->services = $services;
    
                $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
                $atuations = implode(", ", $atuations);
                $demand->atuations = $atuations;
                
                
                $data['demands'][]  = $demand;
      
        } 
    
     return view('diligencia.exe',$data);

   }

    public function __construct()
    {
        $this->middleware('auth');
    }

    

   public function aceitar($id){
    
   	Auth::user()->candidatos()->attach($id);
   	return($id);

   }

   public function candidaturas(){

   	$demands=Auth::user()->candidatos;
     
    $data['demands'] = array();
     
     foreach ($demands as $demand){
        
        //if($demand->ended!=1){
            
            $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
            $services = implode (", ", $services);
            $demand->services = $services;

            $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
            $atuations = implode(", ", $atuations);
            $demand->atuations = $atuations;
            
            
            $data['demands'][]  = $demand;
            
        //}
  
    } 
    
    
   	return view('diligencia.candidaturas', $data);

   }

   public function cancelar($id){

   	Auth::user()->candidatos()->detach($id);
   	return($id);

   }

   public function demandaexe(){

     $demands=Auth::user()->demands()->whereNotNull('executor_id')->whereNull('conclude1')->get();
    
     $data['demands'] = array();
     
     foreach ($demands as $demand){
            
            $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
            $services = implode (", ", $services);
            $demand->services = $services;

            $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
            $atuations = implode(", ", $atuations);
            $demand->atuations = $atuations;
            
            
            $data['demands'][]  = $demand;
  
    } 

   	 return view('demandas.exe',$data);

   }

   public function removerexecutor($id){

   	$demand=Auth::user()->demands()->find($id);
   	$demand->executor_id=null;
   	$demand->save();
   	return($demand);

   }

   public function demandaconcluida($id){

   	$demand=Auth::user()->demands()->find($id);
   	$demand->ended=1;
   	$demand->save();
   	return($demand);

   }

   public function removerdemanda($id){

   	$demand=Auth::user()->demands()->find($id);
    
    //$demand->atuations;
    $demand->services()->detach();
    $demand->atuations()->detach();
    $demand->candidatos()->detach();
    $demand->delete();
    
    
   	return($demand);

   }

   public function desistirdemanda($id){

      Auth::user()->executor()->detach($id);
      $demand->executor_id=null;
      $demand->save();
      return($demand);

   }
   
   
   public function concluir(Request $request){
        
        $demand = Demand::find($request->demand_id);
   	    
        //verifica se é autor
        if($demand->user_id==Auth::user()->id){
            
            $demand->conclude1 = 1;
            
            if($demand->conclude2==1){
              $demand->ended = 1;  
            }
        }
        
        //verifica se é o executor
        if($demand->executor_id==Auth::user()->id){
            $demand->conclude2 = 1;
            if($demand->conclude1==1){
              $demand->ended = 1;  
            }
        }

   	   $demand->save();
       
    return($demand);
          
   }

   public function avaliar(Request $request){

    $demand = Demand::find($request->demand_id);

    //verifica se é autor
        if($demand->user_id==Auth::user()->id){
            $user=$demand->executor()->first();

        } else {

          $user=$demand->user()->first();


        }

        $user->total_rating = $user->total_rating +1 ;
        $user->total_stars = $user->total_stars + $request->stars;

        $user->rate=$user->total_stars / $user->total_rating;

        $user->save();




   }

}
