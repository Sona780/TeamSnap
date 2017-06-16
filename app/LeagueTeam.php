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
                     ->leftJoin('users', 'teams.team_owner_id', 'users.id')
                     ->leftJoin('user_details', 'user_details.users_id', 'users.id')
    				 ->select('league_teams.id', 'league_teams.team_id', 'teams.teamname', 'users.email', 'user_details.firstname', 'user_details.lastname', 'user_details.mobile')
    				 ->get();
    }

    public static function getDivisionTeams($did)
    {
    	return static::where('league_division_id', $did)
    				 ->leftJoin('teams', 'teams.id', 'league_teams.team_id')
    				 ->select('teams.id', 'teams.teamname', 'league_teams.league_division_id')
    				 ->get();
    }

    public static function totalTeams($id)
    {
        return static::where('league_division_id', $id)->count();
    }

    public static function getTeamDiv($tid, $lid)
    {
        return static::where('team_id', $tid)
                     ->leftJoin('league_divisions', 'league_divisions.id', 'league_teams.league_division_id')
                     ->where('league_divisions.league_id', $lid)
                     ->first()
                     ->division_name;
    }

    public static function teamDivs($tid)
    {
        return static::where('team_id', $tid)->select('league_division_id')->get();
    }
}
