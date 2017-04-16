<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use TeamSnap\BaseballRecord;

class Availability extends Model
{
    //
    protected $fillable = [ 'team_users_id','game_team_id' ];

    public $timestamps = false;

    // create availability of memebr of a team
    public static function newAvailability($tuid, $gid)
    {
    	return static::create([
	    			'team_users_id' => $tuid,
	    			'game_team_id'  => $gid,
	    		]);
    }


    // delete asset when a player become unavailable for available
    public static function deleteAvailability($tuid, $gid)
    {
    	return static::where('team_users_id', $tuid)->where('game_team_id', $gid)->delete();
    }


    public static function getBaseballOpponents($tuid)
    {
        $gid = BaseballRecord::where('team_user_id', $tuid)->select('game_team_id')->get();

        return static::PlayerGames($tuid)->where('game_details.result', '!=', '')
                     ->whereNotIn('game_teams.id', $gid->toArray())
                     ->get();
    }

    public static function getBaseballOpponentsCount($tuid)
    {
        return static::where('team_users_id', $tuid)->count();
    }

    public static function getPlayerGames($uid)
    {
        return static::where('team_users_id', $uid)->get();
    }

    public static function getPlayedGames($tuid)
    {
        return static::PlayerGames($tuid)->where('game_details.result', '!=', '')->get();
    }

    public static function PlayerGames($tuid)
    {
        return static::leftJoin('game_teams', 'game_teams.id', 'availabilities.game_team_id')
                     ->leftJoin('game_details', 'game_details.game_team_id', 'game_teams.id')
                     ->select('game_teams.id', 'game_teams.team1_id', 'game_teams.team2_id', 'game_details.date', 'game_details.result')
                     ->where('availabilities.team_users_id', $tuid);
    }
}
