<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueManager extends Model
{
    //
    protected $fillable = [ 'league_id','user_id' ];

    public $timestamps  = false;

    public static function getManagers($id)
    {
    	return static::where('league_id', $id)
    				 ->leftJoin('user_details', 'user_details.users_id', 'league_managers.user_id')
    				 ->leftJoin('users', 'users.id', 'league_managers.user_id')
    				 ->select('league_managers.id', 'users.email', 'users.name', 'user_details.lastname')
    				 ->get();
    }
}
