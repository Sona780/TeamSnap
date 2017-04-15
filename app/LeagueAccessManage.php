<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueAccessManage extends Model
{
    //
    protected $fillable = [ 'league_id','division', 'schedule', 'record', 'media', 'message', 'setting', 'type' ];

    public $timestamps  = false;

    public static function newLeague($id)
    {
    	LeagueAccessManage::create([
    			'league_id' => $id,
    			'type'      => 0,
    			'division'  => 0,
    			'schedule'  => 0,
    			'record'    => 0,
    			'media'     => 0,
    			'message'   => 0,
    			'setting'   => 0,
    		]);

    	LeagueAccessManage::create([
    			'league_id' => $id,
    			'type'      => 1,
    			'division'  => 1,
    			'schedule'  => 1,
    			'record'    => 1,
    			'media'     => 1,
    			'message'   => 1,
    			'setting'   => 1,
    		]);
    }

    public static function getPermissions($id, $ch)
    {
    	return static::where('league_id', $id)->where('type', $ch)->first();
    }
}
