<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueLocation extends Model
{
    //
    protected $fillable = [ 'league_division_id','loc_name', 'loc_detail', 'contact' ];

    public $timestamps  = false;

    public static function divisionLocations($id)
    {
    	return static::where('league_division_id', $id)->get();
    }
}
