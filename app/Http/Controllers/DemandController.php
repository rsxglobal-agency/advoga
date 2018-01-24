<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Demand;
use App\Service;
use App\Atuation;
use Validator;
use Auth;

class DemandController extends Controller
{
	
    
    
    public function lancar(){
        
         //Serviços 
        $services  = Service::all()->toArray();
        $total_i   = count($services);
        $num_col   = 3;
        $total_col = round($total_i / $num_col);
        $cursor    = 0;
        
        $services_data = array();

        for($i = 1; $i<= $num_col; $i++){
           $services_data[$i] = array();
           for($ia=0; $ia<= $total_col; $ia++){
             if (isset($services[$cursor])){
                  $services_data[$i][]          = $services[$cursor];
               }                            
              $cursor++;
           }
        } 
        
        //Áreas de atuacao 
        $atuations = Atuation::all()->toArray();
        
        $total_i   = count($atuations);
        $num_col   = 3;
        $total_col = round($total_i / $num_col);
        $cursor    = 0;
        
        $atuations_data = array();

        for($i = 1; $i<= $num_col; $i++){
           $atuations_data[$i] = array();
           for($ia=0; $ia<= $total_col; $ia++){
             if (isset($atuations[$cursor])){
                  
                  $atuations_data[$i][]  = $atuations[$cursor];
               }                            
              $cursor++;
           }
        } 
        
        $data['services']  = $services_data;
        $data['atuations'] = $atuations_data;
        
        return view('demandas.lancar',$data);
    }
    
     public function store(Request $request){
        
            $messages = array(
                'name.required' => 'O campo t&iacute;tulo &eacute; requerido',
                'description.required' => 'O campo descri&ccedil;&atilde;o &eacute; requerido'
            );
         
            //Validação
            $validator = Validator::make($request->all(),array(
                'name'       => 'required|string|max:200',
                'description' => 'required|string|max:200'
            ),$messages);
            
    
            if ($validator->fails()) {
                return redirect('lancar-demanda')
                            ->withErrors($validator)
                            ->withInput();
            }

		    $demand = new Demand;

			$demand->name= $request->name;
			$demand->description= $request->description;
			$demand->user_id = Auth::user()->id;
			$demand->ended=false;
			//$demand->stars=0; 
			$demand->state_id= $request->state_id;
			$demand->city_id= $request->city_id;

			$demand->save();
            
            if($request->has('atuation_id')){
               $demand->atuations()->attach($request->get('atuation_id'));
            }
            
            if($request->has('service_id')){
               $demand->services()->attach($request->get('service_id'));
            }

			return redirect('/dashboard');

	}

	public function edit($id){
	   
       
         
         //Serviços - Serviços relacionados
        $services     = Service::all()->toArray();
        $servicesRel  = Demand::find($id)->services()->pluck('id')->toArray();
        
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
        $atuationsRel  = Demand::find($id)->atuations()->pluck('id')->toArray();
        
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
        
        $data['up']        = Input::get('up');  
        $data['demand']    = Demand::find($id);
        $data['services']  = $services_data;
        $data['atuations'] = $atuations_data;
        
        return view('demandas.editar',$data);

	}
    
    public function update(Request $request){
        
            $messages = array(
                'name.required' => 'O campo t&iacute;tulo &eacute; requerido',
                'description.required' => 'O campo descri&ccedil;&atilde;o &eacute; requerido'
            );
         
            //Validação
            $validator = Validator::make($request->all(),array(
                'name'       => 'required|string|max:200',
                'description' => 'required|string|max:200'
            ),$messages);
            
    
            if ($validator->fails()) {
                return redirect('/demands/'.$request->id.'/edit/')
                            ->withErrors($validator)
                            ->withInput();
            }
        
           $description  = "";
           if ($request->has('description')){
               $description = $request->description;
           }
        
           Demand::where('id',$request->id)->update(array(
                  "name" =>$request->name,
                  "description" => $description,
                  "state_id" => $request->state_id,
                  "city_id"  => $request->city_id
            ));
               
         
            $demand = Demand::find($request->id);
        
        
            $demand->atuations()->detach();
            $demand->services()->detach();
           
            if($request->has('atuation_id')){
               $demand->atuations()->attach($request->get('atuation_id'));
            }
            
            if($request->has('service_id')){
               $demand->services()->attach($request->get('service_id'));
            }
       
              
        return redirect('/demands/'.$request->id.'/edit/?up=ok');  
    }
    
    public function cadidatos($id = null){
        
        // echo $id;
        $demand = Demand::where('id',$id)->get()->first();

        foreach($demand->candidatos()->get() as $c){
        
        $demand->candidatos()->updateExistingPivot($c->id, ['viewed'=>1]);
        }
         
        $data['candidados'] = array();
        $data['demand']     = array();
        
        if($demand){
            $services = Demand::find($demand->id)->services()->orderBy('name')->pluck('name')->toArray();
            $services = implode (", ", $services);
            $demand->services = $services;
            $atuations = Demand::find($demand->id)->atuations()->orderBy('name')->pluck('name')->toArray();
            $atuations = implode(", ", $atuations);
            $demand->atuations = $atuations;
            foreach($demand->candidatos as $user){
               
               $atuations  = $user->atuations()->get()->pluck('name')->toArray();
               $user->atuations = $atuations = implode(", ", $atuations);
               
               $services  = $user->services()->get()->pluck('name')->toArray();
               $user->services = $services = implode(", ", $services);
               
               $data['candidados'][] = $user;
            }
          $data['demand'] = $demand;    
        } 
        
        

       return view('demandas.candidatos',$data);
        
    }
    

	 public function __construct()
    {
        $this->middleware('auth');
    }
}
