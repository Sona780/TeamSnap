<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class DivisionManager extends Model
{
    //
    protected $fillable = [ 'league_division_id','user_id' ];

    public $timestamps  = false;

    public static function newManager($id, $uid)
    {
        return static::create(['league_division_id' => $id, 'user_id' => $uid]);;
    }

    public static function checkIfManager($id, $uid)
    {
        return static::where('league_division_id', $id)->where('user_id', $uid)->first();
    }

    public static function getManagers($id)
    {
    	return static::where('league_division_id', $id)
    				 ->leftJoin('user_details', 'user_details.users_id', 'division_managers.user_id')
    				 ->leftJoin('users', 'users.id', 'division_managers.user_id')
    				 ->select('division_managers.id', 'users.email', 'users.name', 'user_details.lastname')
    				 ->get();
    }

    public static function geDivisions($id)
    {
    	return static::where('user_id', $id)
    				 ->leftJoin('league_divisions', 'league_divisions.id', 'division_managers.league_division_id')
    				 ->select('league_divisions.league_id AS id', 'league_divisions.id AS ldid', 'league_divisions.division_name AS league_name')
    				 ->get();
    }

    public static function check($uid, $ldid)
    {
    	return static::where('league_division_id', $ldid)->where('user_id', $uid)->count();
    }
}
