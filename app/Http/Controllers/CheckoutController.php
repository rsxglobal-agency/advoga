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
use Validator;
use Requests;


class CheckoutController extends Controller
{
    
    /* Sandbox */
    private $api_url           = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/';
    private $checkout_url      = 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=';
    private $transactions_url  = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/';
    private $notifications_url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/';
    private $email             = "rsxglobaldesenvolvedor@gmail.com";
    private $token             = "C19032D9F9CC4482AA63248F865CE640";

    
	public function __construct()
    {
      //$this->middleware('auth',array('except'=>array('compra','store','cadastro','update')));
      //['except' => ['getActivate', 'anotherMethod']
    }
    
    //Segunda etapa do cadastro, compra de créditos
    public function index(){
       
            $data['email']            = $this->email;
            $data['token']            = $this->token;
            $data['currency']         = 'BRL';
            $data['itemId1']          = '13'; // pode ser a id da compra
            $data['itemDescription1'] = 'Plano Mensal';
            $data['itemAmount1']      = '30.00';
            $data['itemQuantity1']    = '1';
            $data['itemWeight1']      = '0';
            $data['reference']        = 'P002';
            $data['redirectURL']      = url('/checkout/redirect-url');
            
            $headers = array('Content-Type' => 'application/x-www-form-urlencoded; charset=ISO-8859-1');
            
            $request = Requests::post($this->api_url, $headers, $data);
            
            if($request->status_code==200){
                
               $xml = simplexml_load_string($request->body);  
               
               if (isset($xml->code)){
                    
                    //echo $xml->code;
                    //Tudo certo redireciona para o pagueseguro
                    return redirect($this->checkout_url.$xml->code);
                  
               }else{
                 return redirect('checkout/erro');
               }
            }else{
                 return redirect('checkout/erro');
            }

    }
    
    //Url de redirecionamento após o checkout
    //http://advoga.elasticapp.com.br/checkout/redirect-url?id=9601DD22-304F-4FE1-A98A-2A1186F51636
    /** 
    *   https://dev.pagseguro.uol.com.br/documentacao/pagamento-online/notificacoes/api-de-notificacoes#status-da-transacao
    *   1	Aguardando pagamento: o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.
    *   2	Em análise: o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.
    *   3	Paga: a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.
    *   4	Disponível: a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.
    *   5	Em disputa: o comprador, dentro do prazo de liberação da transação, abriu uma disputa.
    *   6	Devolvida: o valor da transação foi devolvido para o comprador.
    *   7	Cancelada: a transação foi cancelada sem ter sido finalizada.
    *   8	Debitado: o valor da transação foi devolvido para o comprador.
    *   9	Retenção temporária: o comprador contestou o pagamento junto à operadora do cartão de crédito ou abriu uma demanda judicial ou administrativa (Procon).
    */    
    //F880735DF4F4B659949ACF92DD1D80D2
    public function redirect_url(Request $req){
        

       $q = "".$req->id."?email=".$this->email."&token=".$this->token."";
       
       $request = Requests::get($this->transactions_url.$q);
       
          if($request->status_code==200){
            
               $xml = simplexml_load_string($request->body);  
                
                 if (isset($xml->status)){
                      
                       //$xml->status; 
                       //$xml->items->item->id;
                        //echo $xml->items->item->id;
                        
                        echo '<pre>';
                         print_r($xml);
                        echo '</pre>';
                    
                          //echo $xml->status;
                         //Tudo certo redireciona para o pagueseguro
                         //return redirect($this->checkout_url.'?code='.$xml->code);
                         //header('Location: http://www.example.com/');
                         //exit;
                }else{
                    return redirect('checkout/erro');
               }  
            }else{
                 return redirect('checkout/erro');
          }
    }
    
    //Status do checkout
    public function status(Request $request){
       
       $code = $request->notificationCode;
       //$type = $request->notificationType;
       
       //$data  = 'Code:'. $code ."\n";
       //$data .= 'Type:'. $type ."\n"; 
       //$code = "DD06E5-DC86438643B8-CFF4816F9B4F-36860E";
       //16AC0287-45C9-4BAC-832C-87F4A00259DF 
       
       $q = "".$code."?email=".$this->email."&token=".$this->token."";
       $request = Requests::get($this->notifications_url.$q);
 
       if($request->status_code==200){
        
             $xml = simplexml_load_string($request->body);
             
             //echo '<pre>';
             //      print_r($xml);
             //echo '</pre>';
            
       }
       
       
      
       //Code:DD06E5-DC86438643B8-CFF4816F9B4F-36860E
       //Type:transaction
       //@file_put_contents('../teste/file.txt',$data);
       
    }
    
    
    public function erro(){
       
       echo 'Erro inesperado durante o processo de checkout.';
        
    }
    
    //rota atualizar-cadastro
  
      
}
