<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueMatchDetail extends Model
{
    //
    protected $fillable = [ 'league_division_id','game_team_id', 'result', 'match_date', 'hour', 'minute', 'time', 'league_location_id' ];

    public $timestamps  = false;

    public static function matches($id)
    {	$div = LeagueDivision::where('league_id', $id)->select('id')->get();
    	return static::whereIn('league_match_details.league_division_id', $div->toArray())
    				 ->rightJoin('league_locations', 'league_locations.id', 'league_match_details.league_location_id')
    				 ->leftJoin('game_teams', 'game_teams.id', 'league_match_details.game_team_id')
    				 ->get();
    }

    public static function getDetail($id)
    {
        return static::where('game_team_id', $id)->first();
    }
}
