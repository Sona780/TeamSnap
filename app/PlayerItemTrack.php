<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class PlayerItemTrack extends Model
{
    //
    protected $fillable = [ 'team_users_id','team_items_id' ];

    public $timestamps  = false;

    public static function createNew($tuid, $iid)
    {
    	return static::create([
    			'team_users_id' => $tuid,
    			'team_items_id' => $iid,
    		]);
    }

    public static function deletePlayerItem($tuid, $iid)
    {
    	return static::where('team_users_id', $tuid)->where('team_items_id', $iid)->delete();
    }


    public static function getItems($pid)
    {
    	return static::where('team_users_id', $pid)->select('team_items_id')->get();
    }

    public static function checkPlayerItem($tuid, $iid)
    {
        return static::where('team_users_id', $tuid)->where('team_items_id', $iid)->first();
    }
}
