<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [
    //    'name', 'email', 'password',
    //];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function atuations()
    {
        return $this->belongsToMany('App\Atuation');
    }

    public function titulation()
    {
        return $this->belongsTo('App\Titulation');
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

    public function demands() {
    return $this->hasMany('App\Demand');
    }

    public function candidatos() {
    return $this->belongsToMany('App\Demand', 'demand_executor', 'executor_id', 'demand_id')->orderby('created_at', 'desc');
    }

    public function demandExecutors() {
    return $this->hasMany('App\Demand', 'executor_id');
    }

    public function getEscondeBotaoAttribute() {
       
    return $this->attributes['tour'] || $this->attributes['titulation_id'] == 5;

    }

    public function payments(){

        return $this->hasMany('App\Payment');
    }


}
