<?php

namespace App\Http\Controllers;


use App\User;
use App\Payment;
use Illuminate\Support\Facades\Log;
use Requests;

class PaymentController extends Controller
{
    public function status() {

  header("access-control-allow-origin: https://pagseguro.uol.com.br");

  $notificationCode = $_POST['notificationCode'];
  $notificationType = $_POST['notificationType'];
  $data['token'] = 'C19032D9F9CC4482AA63248F865CE640';
  $data['email'] = 'rsxglobaldesenvolvedor@gmail.com';

  $data = http_build_query($data);
  $url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

  $curl = curl_init($url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_URL, $url);
  $xml = curl_exec($curl);
  //curl_close($curl);

  if($xml == 'Unauthorized'){

    $return = 'Não Autorizado';
    echo $return;
    exit;

  }else{
    $xml = simplexml_load_string($xml);

    $reference = $xml -> reference;
    $status = $xml -> status;
    
   $payment = Payment::where('user_id', $reference)->update(['status'=>$status]);

    Log::info('reference: '.$reference);
    Log::info('status: '.$status);
    
    echo $url;
		}

    }

}