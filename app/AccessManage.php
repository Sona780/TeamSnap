<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class AccessManage extends Model
{
    //
    protected $fillable = [ 'team_id', 'type', 'member', 'schedule', 'availability', 'record', 'media', 'message', 'asset', 'setting' ];

    public $timestamps = false;

    public static function newTeam($tid, $type, $status)
    {
    	return static::create([
    		'team_id'      => $tid,
    		'type'	       => $type,
    		'member'	   => $status,
    		'schedule'	   => $status,
    		'availability' => $status,
    		'record'	   => $status,
    		'media'	       => $status,
    		'message'	   => $status,
    		'asset'	       => $status,
    		'setting'	   => $status,
    	]);
    }

    public static function scopePublicAccess($query, $tid)
    {
    	$query->where('team_id', $tid)->where('type', 0);
    }

    public static function scopeManagerAccess($query, $tid)
    {
    	$query->where('team_id', $tid)->where('type', 1);
    }

    public static function findPublicAccessDetail($tid)
    {
    	return static::where('team_id', $tid)->where('type', 0)->first();
    }

    public static function findManagerAccessDetail($tid)
    {
    	return static::where('team_id', $tid)->where('type', 1)->first();
    }

    public static function getDetail($id)
    {
        return static::where('team_id', $id)->where('type', 1)->first();
    }
}
