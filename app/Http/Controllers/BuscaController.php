<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Service As Service;
use App\Atuation As Atuation;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;

class BuscaController extends Controller
{


	public function __construct()
    {
        $this->middleware('auth');
    }
    
    //rota atualizar-cadastro
    public function index(){
        
        //Serviços - Serviços relacionados
        $services     = Service::all()->toArray();
        $servicesRel  = Auth::user()->services->pluck('id')->toArray();
        
        $total_i   = count($services);
        $num_col   = 3;
        $total_col = round($total_i / $num_col);
        $cursor    = 0;
        
        $services_data = array();

        for($i = 1; $i<= $num_col; $i++){
           $services_data[$i] = array();
           for($ia=0; $ia<= $total_col; $ia++){
             if (isset($services[$cursor])){
                  
                  //$checked = (in_array($empr[$cursor]['id'],$relacao_empr))? 'checked="checked"':''; 
                  $services[$cursor]['checked'] = '';
                  if(in_array($services[$cursor]['id'],$servicesRel)){
                     $services[$cursor]['checked'] = 'checked="checked"';
                  }

                  $services_data[$i][]          = $services[$cursor];
               }                            
              $cursor++;
           }
        } 
        
        //Áreas de atuacao - Areas de atuacao relacionadas
        $atuations     = Atuation::all()->toArray();
        $atuationsRel  = Auth::user()->atuations->pluck('id')->toArray();
        
        $total_i   = count($atuations);
        $num_col   = 3;
        $total_col = round($total_i / $num_col);
        $cursor    = 0;
        
        $atuations_data = array();

        for($i = 1; $i<= $num_col; $i++){
           $atuations_data[$i] = array();
           for($ia=0; $ia<= $total_col; $ia++){
             if (isset($atuations[$cursor])){
                  
                  //$checked = (in_array($empr[$cursor]['id'],$relacao_empr))? 'checked="checked"':''; 
                  $atuations[$cursor]['checked'] = '';
                  if(in_array($atuations[$cursor]['id'],$atuationsRel)){
                     $atuations[$cursor]['checked'] = 'checked="checked"';
                  }

                  $atuations_data[$i][]  = $atuations[$cursor];
               }                            
              $cursor++;
           }
        } 
        
        $data['services']  = $services_data;
        $data['atuations'] = $atuations_data;
        
        $data['up'] = Input::get('up');  
        
        return view("busca.form",$data);
    }
    
    public function resultados(Request $request){
        
          $name        = $request->get('name');
          $state_id    = $request->get('state_id');
          $city_id     = $request->get('city_id');
         // $rate        = $request->get();
          
         // DB::enableQueryLog();
          
          $query = DB::table('users');
          $query = $query->select("users.*");
          $query->where('name','like','%'.$name.'%');
          
          if (!empty($state_id)){
            $query->where('state_id',$state_id);
          }
        
          if (!empty($city_id)){
            $query->where('city_id',$city_id);
          }
          
          if($request->has('atuation_id')){
               $atuations = $request->get('atuation_id');
               $query->join('atuation_user', function ($join) use ($atuations){
                 $join->on('users.id', '=', 'atuation_user.user_id')
                 ->whereIn('atuation_user.atuation_id',$atuations);
               });
          }
            
          if($request->has('service_id')){
               $services  =  $request->get('service_id');
               $query->join('service_user', function ($join) use ($services){
                 $join->on('users.id', '=', 'service_user.user_id')
                 ->whereIn('service_user.service_id',$services);
               });
          }
          
        $query->where('id','<>',Auth::user()->id);
          
        $data['results'] = $query->distinct('users.id')->get();
        
       //dd(DB::getQueryLog());
        
       return view("busca.resultados",$data);
    }
    
}
