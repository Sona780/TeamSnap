<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LocationDetail extends Model
{
    //
    protected $fillable = [ 'team_id', 'detail', 'name','address', 'link', 'type' ];

    public $timestamps  = false;

    public static function getDetail($id)
    {
    	return static::where('team_id', $id)->first();
    }

    public static function getLocations($id, $ch)
    {
    	return static::where('team_id', $id)->where('type', $ch)->get();
    }
}
