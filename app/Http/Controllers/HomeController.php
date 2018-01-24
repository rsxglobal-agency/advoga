<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Demand;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * A listagem do dashboard mostra demandas que não foram criadas pelo usuario atual
     * E também verifica se a demanda não está reacionada a ele como executor
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $candidate=Auth::user()->candidatos->pluck('id');

        $demands = Demand::where('user_id', '<>', Auth::user()->id) //Auth::user()->id
            ->whereNull('executor_id')
            ->whereNotIn('id',$candidate)
            ->orderby('created_at', 'desc')
            ->get();
            
        $data['demands'] = array();
         
        foreach ($demands as $demand){
            
            $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
            $services = implode (", ", $services);
            $demand->services = $services;

            $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
            $atuations = implode(", ", $atuations);
            $demand->atuations = $atuations;
            
            //$demand->user = $demand->user()->select();
            
            
            $data['demands'][]  = $demand;
  
        } 
   
       return view('dashboard', $data);
    
    }
    
     /**
     * A listagem mostra as demandas criadas pelo usuário atual
     */
    public function mydemand()
    {
       
       
       $demands = Demand::where('user_id',Auth::user()->id)->orderby('created_at', 'desc')->get();

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
        
        
        return view('demandas.lancadas', $data);

    }

     public function historic()
    {

        //$demands  = Auth::user()->demands()->where('ended', 1)->get();
        
        $demands = Demand::where('ended',1)
        ->where(function($query){
             $query->where('user_id',Auth::user()->id);
             $query->orWhere('executor_id',Auth::user()->id);
        })->orderby('created_at', 'desc')->get();
        
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
        
        return view('historical', $data);

    }
        
}
