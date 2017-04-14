<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class League extends Model
{
    //
    protected $fillable = [ 'user_id', 'tot_teams', 'league_name' ];

	public static function matches($id)
    {
    	return static::where('leagues.id', $id)
    				 ->leftJoin('league_divisions', 'league_divisions.league_id', 'leagues.id')
    				 ->rightJoin('league_matches', 'league_matches.league_division_id', 'league_divisions.id')
    				 ->rightJoin('league_locations', 'league_locations.id', 'league_matches.league_location_id')
    				 ->select('league_divisions.division_name', 'league_locations.*', 'league_matches.*')
    				 ->get();
    }

    public static function totalMatches($id)
    {
    	return static::allMatches($id)->count();
    }

    public static function playedMatches($id)
    {
    	return static::allMatches($id)->where('match_date', '<' , Carbon::now()->format('d/m/Y'))->count();
    }

    public static function totalTeams($id)
    {
    	return static::where('leagues.id', $id)
    				 ->leftJoin('league_divisions', 'league_divisions.league_id', 'leagues.id')
    				 ->rightJoin('league_teams', 'league_teams.league_division_id', 'league_divisions.id')
    				 ->count();
    }

    public static function allMatches($id)
    {
    	return static::where('leagues.id', $id)
    				 ->leftJoin('league_divisions', 'league_divisions.league_id', 'leagues.id')
    				 ->rightJoin('league_matches', 'league_matches.league_division_id', 'league_divisions.id');
    }
}
