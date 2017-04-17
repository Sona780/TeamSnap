<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class GameTeam extends Model
{
    //
    protected $fillable = [ 'team1_id','team2_id', 'game_type' ];

    public function baseballRecord()
    {
        return $this->hasMany('TeamSnap\BaseballRecord');
    }

    public static function newGame($t1, $t2, $type)
    {
    	return static::create(['team1_id' => $t1, 'team2_id' => $t2, 'game_type' => $type]);
    }

    public static function getGames($id)
    {
    	return static::where('team1_id', $id)->orWhere('team2_id', $id)->latest('created_at')->get();
    }

    public static function getOpponents($id)
    {
        return static::where('team1_id', $id)
                     ->where('game_type', 0)
                     ->leftJoin('teams', 'teams.id', 'game_teams.team2_id')
                     ->leftJoin('game_details', 'game_details.game_team_id', 'game_teams.id')
                     ->leftJoin('opponent_details', 'opponent_details.id', 'game_details.opponent_detail_id')
                     ->select('opponent_details.id', 'teams.teamname')
                     ->distinct('teams.teamname')
                     ->get();
    }

    public static function getPlayedGames($id)
    {
        return static::where(function($query) use($id){
                        $query->where('team1_id', $id)->orWhere('team2_id', $id);
                     })->leftJoin('game_details', 'game_details.game_team_id', 'game_teams.id')
                     ->where('game_details.result', '!=', '')
                     ->select('game_teams.*', 'game_details.result')
                     ->union(GameTeam::playedLeagueGames($id))
                     ->get();
    }

    public static function playedLeagueGames($id)
    {
        return static::where(function($query) use($id){
                        $query->where('team1_id', $id)->orWhere('team2_id', $id);
                     })->leftJoin('league_match_details', 'league_match_details.game_team_id', 'game_teams.id')
                     ->where('league_match_details.result', '!=', '')
                     ->select('game_teams.*', 'league_match_details.result');
    }
}
