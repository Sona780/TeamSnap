<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class OpponentDetail extends Model
{
    //
    protected $fillable = [ 'team_id','contact_person', 'phone_no', 'email' ];

    public $timestamps  = false;

    public static function getDetail($id)
    {
    	return static::where('team_id', $id)->first();
    }

    public static function getOpponentTeamID($id)
    {
    	return static::where('opponent_details.id', $id)
    				 ->leftJoin('game_details', 'game_details.opponent_detail_id', 'opponent_details.id')
    				 ->leftJoin('game_teams', 'game_teams.id', 'game_details.game_team_id')
    				 ->select('game_teams.team2_id AS id')
    				 ->first();
    }
}
