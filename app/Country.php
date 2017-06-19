<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable = [ 'tld','country_name' ];

    public $timestamps = false;
}
