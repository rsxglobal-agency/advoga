<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    public function atuations()
    {
        return $this->belongsToMany('App\Atuation');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }
    

    public function state(){

        return $this->belongsTo('App\State');
    }

    public function city(){
    return $this->belongsTo('App\City');
    }

    public function user() {
    return $this->belongsTo('App\User');
    }

    public function executor() {
    return $this->belongsTo('App\User', 'executor_id');
    }

    public function candidatos() {
      return $this->belongsToMany('App\User', 'demand_executor', 'demand_id', 'executor_id')->withPivot('viewed');
    }
    
    public function messages(){
       return $this->hasMany('App\Message');
    }
    


}


