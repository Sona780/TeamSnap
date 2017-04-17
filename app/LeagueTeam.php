<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueTeam extends Model
{
    //
    protected $fillable = [ 'league_division_id','team_id' ];

    public $timestamps  = false;

    public static function getTeams($ldid)
    {
    	return static::where('league_division_id', $ldid)
    				 ->leftJoin('teams', 'teams.id', 'league_teams.team_id')
    				 ->select('league_teams.id', 'teams.teamname')
    				 ->get();
    }

    public static function getDivisionTeams($did)
    {
    	return static::where('league_division_id', $did)
    				 ->leftJoin('teams', 'teams.id', 'league_teams.team_id')
    				 ->select('teams.id', 'teams.teamname', 'league_teams.league_division_id')
    				 ->get();
    }
}
