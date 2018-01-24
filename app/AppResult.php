<?php

use Illuminate\Http\Response;

namespace App;

class AppResult
{
   public $error_id;
   
   public $error_msg;
   
   public function __construct($result, $error_msg = null, $error_id = 1)
   {
	   $this->result = $result;
	   $this->error_id = $error_id;
	   $this->error_msg = $error_msg;
   }
   
   public static function result($result)
   {
	   return array('result' => $result);
   }
   
   public static function error($error_msg, $error_id = 1, $extra_param = null)
   {
      if($error_msg instanceof \Exception)
      {
         $error_id = $error_msg->getCode();
         $error_msg = $error_msg->getMessage();
      }
	   $a = array('error' => ['id' => $error_id, 'msg' => $error_msg . ' (' . $error_id . ')']);
	   if($extra_param)
		   $a['extra'] = $extra_param;
	   return $a;
	  //return new \Illuminate\Http\JsonResponse($a, 503);
   }
   
   public function toArray()
   {
	   if($this->error_msg)
		   return array('error' => ['id' => $this->error_id, 'msg' => $this->error_msg]);
	   else
		   return array('result' => $this->result);
   }
}
