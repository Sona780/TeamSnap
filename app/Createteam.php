<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class Createteam extends Model
{
    protected $fillable = [
         'teamname', 'sport','country','zip'
    ];


    public $timestamps = false;
}
