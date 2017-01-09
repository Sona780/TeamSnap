<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
         'teamname', 'sport','country','zip','user_id'
    ];


    public $timestamps = false;


    public function user()
    {
    	return $this-> belongsTo('App\User');
    }

     public function members()
    {
        return $this -> hasMany('App\Member');
    }
}
