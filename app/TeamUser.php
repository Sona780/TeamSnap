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
    	return static::leftJoin('user_details', 'team_users.user_id', '=', 'user_details.user_id')
                     ->leftJoin('player_ctgs', 'player_ctgs.user_id', '=', 'team_users.user_id')
                     ->leftJoin('users', 'users.id', '=', 'team_users.user_id')
                     ->where('team_users.team_id', $id);
    }
}
