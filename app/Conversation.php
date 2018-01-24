<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
     public $timestamps = true;
     
     
    public function from_user(){
       return $this->belongsTo('App\User','from_user','id');
    }
    
    public function to_user(){
       return $this->belongsTo('App\User','to_user','id');
    }
     
     public function messages(){
       return $this->hasMany('App\Message');
    }
     
     public function demand(){
        return $this->belongsTo('App\Demand');

     }
}
