<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addmember extends Model
{
     protected $fillable = [
         'firstname', 'lastname','email','mobile','role','birthday','city','state'
    ];


    public $timestamps = false;
}

