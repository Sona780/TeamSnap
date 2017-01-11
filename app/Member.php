<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     protected $fillable = [
         'firstname', 'lastname','flag','email','mobile','role','birthday','city','state','team_id',
    ];


    public $timestamps = false;

     public function userteam()
    {
    	return $this-> belongsTo('TeamSnap\Team'); 
    }

}
