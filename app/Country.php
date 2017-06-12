<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable = [ 'tld','country_name' ];

    public $timestamps = false;
}
