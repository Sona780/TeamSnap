<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    //
    protected $fillable = [ 'zone_name' ];

    public $timestamps = false;
}