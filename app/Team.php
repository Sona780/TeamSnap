<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
    'teamname', 'sport','country','zip','user_id','team_logo','team_owner_id','team_color_first','team_color_second'
    ];


    public $timestamps = false;


    public function user()
    {
    	return $this-> belongsTo('TeamSnap\User');
    }

    public function ctgs()
    {
    	return $this -> hasMany('TeamSnap\Ctg');
    }

   
}
