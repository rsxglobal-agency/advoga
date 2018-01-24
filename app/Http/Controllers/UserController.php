<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\Service As Service;
use App\Atuation As Atuation;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Payment;
use Illuminate\Support\Facades\Log;
use Validator;
use Requests;

class UserController extends Controller
{
    
    private $api_url = 'sandbox.pagseguro.uol.com.br';
    
    //Email rsxglobaldesenvolvedor@gmail.com
    //Token  C19032D9F9CC4482AA63248F865CE640
    
    //https://ws.pagseguro.uol.com.br/v2/checkout
    //https://ws.sandbox.pagseguro.uol.com.br/v2/checkout
    
    //POST https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=suporte@lojamodelo.com.br&token=57BE455F4EC148E5A54D9BB91C5AC12C


	 public function __construct()
    {
        $this->middleware('auth',array('except'=>array('compra','store','cadastro','update','pagamento', 'notificacao')));
        //['except' => ['getActivate', 'anotherMethod']
        
    }
    
    public function compra(){
        
            $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?';
        
      
           $data = array(  
                          'email'            => 'rsxglobaldesenvolvedor@gmail.com',  
                          'token'            => 'C19032D9F9CC4482AA63248F865CE640', 
                          'currency'         => 'BRL',
                          'itemId1'          => '001',
                          'itemDescription1' => 'Produto PagSeguroI',
                          'itemAmount1'      => '99999.99',
                          'itemQuantity1'    => '1',
                          'itemWeight1'      => '1000',
                          'reference'        => 'REF1234',
                          'senderName'       => 'Jose Comprador',
                          'senderEmail'      => 'c30977699293373954902@sandbox.pagseguro.com.br',
                          'senderAreaCode'   => '99',
                          'senderPhone'      => '99999999',
                          'shippingType'     => '1',
                          'shippingAddressStreet' => 'Av. PagSeguro',
                          'shippingAddressNumber' => '9999',
                          'shippingAddressComplement' => '99',
                          'shippingAddressDistrict'   => 'Jardim Internet',
                          'shippingAddressPostalCode'  => '99999999',
                          'shippingAddressCity'   => 'Exemplo',
                          'shippingAddressState'  => 'SP',
                          'shippingAddressCountry'=> 'ATA'
                        );
      
            $q = http_build_query($data);
     

            $headers = array('Content-Type' => 'application/xml; charset=ISO-8859-1');
            $options = array();
            $request = Requests::post($url.$q, $headers, $options);
            
            var_dump($request->status_code);
            // int(200)
            
            var_dump($request->headers['content-type']);
            // string(31) "application/json; charset=utf-8"
            
            var_dump($request->body);
      
        
        
    }

   
    
    //rota atualizar-cadastro
    public function update(){
        
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
        
        $user = Auth::user();
        
        $data['user']      = User::where('id',$user->id)->first();
        $data['services']  = $services_data;
        $data['atuations'] = $atuations_data;
        
   //echo '<pre>';
  // print_r($atuations_data);
   //echo '</pre>';
        $data['up'] = Input::get('up');  
        
        return view("cadastro.editar",$data);
    }
    
    //rota atualizar-cadastro
    public function updatePost(Request $request){
           
           $description  = "";
           if ($request->has('description')){
               $description = $request->description;
           }
           
           $social  = "";
           if ($request->has('social')){
               $social = $request->social;
           }
 
          User::where('id',$request->id)->update(array(
              "name" =>$request->name,
              "description" => $description,
              "social" => $social,
              "formation_id" => $request->formation_id,
              "titulation_id" => $request->titulation_id,
              "state_id" => $request->state_id,
              "city_id"  => $request->city_id
           ));

          if ($request->password!=""){
            $user=User::find($request->id);

            $user->password=Hash::make($request->password);

            $user->save();


          }

            /* Imagem do perfil */
            $this->image_process($request,$request->id);
           
            $user = User::find($request->id);
            $user->atuations()->detach();
            $user->services()->detach();
           
            if($request->has('atuation_id')){
               $user->atuations()->attach($request->get('atuation_id'));
            }
            
            if($request->has('service_id')){
               $user->services()->attach($request->get('service_id'));
            }
         
         
          return redirect('/atualizar-cadastro/?up=ok');   
            
    }
    
    
    //Formulário de cadastro
    public function cadastro(){
        
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

        return view("cadastro.adicionar",$data);
    }
   
    //post do form cadastro
	public function store(Request $request){
	     
             $messages = array(
                'required'            => 'O campo :attribute &eacute; requerido',
                'email.unique'        => 'O e-mail informado j&aacute; est&aacute; em uso.',
                'password.min'        => 'Senha dever ter no m&iacute;nimo 6 caracters.',
                'password.confirmed'  => 'As senhas informadas n&atilde;o conferem.',
              //  'description.required'=> 'A frase de apresenta&ccedil;&atilde;o &eacute; requerida.'
            );
         
            //Validação
            $validator = Validator::make($request->all(),array(
                'name'        => 'required|string|max:255',
                'email'       => 'required|string|email|max:255|unique:users',
                'password'    => 'required|string|min:6|confirmed',
              //  'description' => 'required'
            ),$messages);
            
    
            if ($validator->fails()) {
              
              // return ['errors'=>$validator->errors()];
                return redirect('cadastro')
                            ->withErrors($validator)
                            ->withInput();
            }
	   

           $description  = "";
           
           if ($request->has('description')){
               $description = $request->description;
           }

		    $user = new User;

			$user->name  = $request->name;
			$user->email = $request->email;
			$user->active = 1;
			$user->description = "";
			$user->social= "";
			$user->formation_id = $request->formation_id;
			$user->titulation_id = $request->titulation_id;
			$user->password= Hash::make($request->password);
			$user->state_id= $request->state_id;
			$user->city_id = $request->city_id;
      //$user->tour = $request->tour_gratuito;
            $user->image   = "";
			$user->save();
            
            /*if($request->has('atuation_id')){
               $user->atuations()->attach($request->get('atuation_id'));
            }
            
            if($request->has('service_id')){
               $user->services()->attach($request->get('service_id'));
            }
            */
            
            //Atualiza a imagem caso exista
            //$this->image_process($request,$user->id);

            //return $user->id;
            
            //Login atomático
            $user = User::where('id',$user->id)->first();
            
            
            Auth::login($user,true);
            //$this->auth->login($user);
            
            //Redireciona para o painel
            return redirect('dashboard');
  
	} 

  public function assinatura(){

    return view('assinatura');

  }

    public function pagamento(Request $request, $user_id){


  $data['token'] = '4713E250A5604BA78A3F1BFCE1804725';
  $data['email'] = 'rsxglobaldesenvolvedor@gmail.com';
  $data['itemId1'] = '1';
  $data['itemQuantity1'] = '1';
  $data['itemDescription1'] = 'Advoga Mensal';
  $data['itemAmount1'] = '30.00';
  $data['currency'] = 'BRL';
  $data['reference'] = $user_id;

  $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

  $plano = $data['itemDescription1'];

  $data = http_build_query($data);

  $curl = curl_init($url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
  curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  $xml = curl_exec($curl);

  if($xml == 'Unauthorized'){

    return 'false';
    

  }else{

    curl_close($curl);

    $xml = simplexml_load_string($xml);

    $token = $xml -> code;

    $date = date('Y-m-d H:i:s');

    $payment = new Payment;

    $payment->token = $token;
    $payment->plano = 'Plano Mensal';
    $payment->user_id = $request->user_id;
    $payment->status = 0;

    $payment->save();
    return $token;


    }
  }

    
    public function image_process($request,$id){
          
         if ($request->hasFile('photo')){
            
             if ($request->file('photo')->isValid()){
                
                  $path = $request->photo->path();
                  
                  if (getimagesize($path)!==false){

                      //Exlui a imagem aterior caso exista
                      if($request->has('old_photo')){
                          Storage::delete(public_path("/uploads/avatars")."/".$request->old_photo);
                      }
                     
                      $photo_perfil = ""; 
                      $extension    = $request->photo->extension();
                      
                       $photo_perfil = 'foto_avatar_'.$id.".jpg";
                      
                        $new_path = public_path("/uploads/avatars")."/".$photo_perfil;
                        
                        @unlink($new_path);
                        
                        Image::configure(array('driver' => 'gd'));
                      
                        Image::make($path)->resize(200,null,function($constraint){
                            $constraint->aspectRatio();
                        })->save($new_path);
                        
                       // $img->resize(200,null, function ($constraint) {
                        //    $constraint->aspectRatio();
                        //});
                      
                      User::where('id',$id)->update(array(
                           'image' => $photo_perfil
                      ));

                 }
             }
         }
         
         return true;
    }
    
    public function show($id){

      return User::with(["state","city", "atuations", "services", "titulation"])->find($id);

    }
    
}
