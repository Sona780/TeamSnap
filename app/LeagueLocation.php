<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueLocation extends Model
{
    //
    protected $fillable = [ 'league_division_id','loc_name', 'loc_detail', 'contact' ];

    public $timestamps  = false;
}
