<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    protected $table = 'team_users';
    protected $fillable = [
        'team_id','user_id'
    ];


    public $timestamps = false;

    public static function members($id)
    {
    	return static::leftJoin('users', 'users.id', '=', 'team_users.user_id')
                     ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                     ->leftJoin('player_ctgs', 'users.id', '=', 'player_ctgs.user_id')
                     ->where('team_users.team_id', $id);
    }
}
