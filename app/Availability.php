<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

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
}
