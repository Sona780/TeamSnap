<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class LeagueMatchDetail extends Model
{
    //
    protected $fillable = [ 'league_division_id','game_team_id', 'result', 'match_date', 'hour', 'minute', 'time', 'league_location_id' ];

    public $timestamps  = false;

    public static function matches($id)
    {	//$div = LeagueDivision::where('league_id', $id)->select('id')->get();
    	return static::where('league_match_details.league_division_id', $id)
    				 ->rightJoin('league_locations', 'league_locations.id', 'league_match_details.league_location_id')
    				 ->leftJoin('game_teams', 'game_teams.id', 'league_match_details.game_team_id')
    				 ->get();
    }

    public static function getDetail($id)
    {
        return static::where('game_team_id', $id)->first();
    }

    public static function matchUpdate($r, $l)
    {
        return static::where('game_team_id', $r->mid)->update([
                'result'             => $r->result,
                'match_date'         => $r->match_date,
                'hour'               => $r->hour,
                'minute'             => $r->minute,
                'time'               => $r->time,
                'league_location_id' => $l
            ]);
    }
}
