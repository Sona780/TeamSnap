<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use TeamSnap\BaseballRecord;

class Availability extends Model
{
    //
    protected $fillable = [ 'team_users_id','games_id' ];

    public $timestamps = false;

    // create availability of memebr of a team
    public static function newAvailability($tuid, $gid)
    {
    	return static::create([
	    			'team_users_id' => $tuid,
	    			'games_id' 		=> $gid,
	    		]);
    }


    // delete asset when a player become unavailable for available
    public static function deleteAvailability($tuid, $gid)
    {
    	return static::where('team_users_id', $tuid)->where('games_id', $gid)->delete();
    }


    public static function getBaseballOpponents($tuid)
    {
        $gid = BaseballRecord::where('team_user_id', $tuid)->select('game_id')->get();

        return static::where('availabilities.team_users_id', $tuid)
                     ->leftJoin('games', 'games.id', 'availabilities.games_id')
                     ->where('games.date', '<', Carbon::now())
                     ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                     ->select('games.id', 'games.date', 'opponents.name')
                     ->whereNotIn('games.id', $gid->toArray())
                     ->get();
    }

    public static function getBaseballOpponentsCount($tuid)
    {
        return static::where('team_users_id', $tuid)
                     ->count();
    }
}
