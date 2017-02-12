<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
         'teamname', 'sport','country','zip','user_id','team_logo'
    ];


    public $timestamps = false;


    public function user()
    {
    	return $this-> belongsTo('TeamSnap\User');
    }

   
}
