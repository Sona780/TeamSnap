<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueDivision extends Model
{
    //
    protected $fillable = [ 'league_id','division_name', 'parent_id' ];

    public $timestamps  = false;

    public function scopeRootDivision($query, $id)
    {
    	$query->where('league_id', $id)->where('parent_id', 0);
    }

    public static function findTeamDivisions($id)
    {
    	return static::where('league_divisions.league_id', $id)
    				 ->rightJoin('league_teams', 'league_teams.league_division_id', 'league_divisions.id')
    				 ->distinct('league_teams.league_division_id')
    				 ->select('league_divisions.division_name', 'league_divisions.id')
    				 ->get();
    }
}
