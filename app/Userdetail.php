<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Userdetail extends Model
{
     protected $table = 'user_details';
     protected $fillable = [
         'firstname', 'lastname','flag','email','mobile','role','birthday','city','state','user_id','avatar',
    ];


    public $timestamps = false;
}
