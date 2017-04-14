<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueMatch extends Model
{
    //
    protected $fillable = [ 'league_division_id','team1', 'team2', 'match_date', 'hour', 'minute', 'time', 'league_location_id' ];

    public $timestamps  = false;
}
