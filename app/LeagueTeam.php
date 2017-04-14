<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueTeam extends Model
{
    //
    protected $fillable = [ 'league_division_id','team_name', 'owner_first_name', 'owner_last_name', 'owner_email' ];

    public $timestamps  = false;
}
