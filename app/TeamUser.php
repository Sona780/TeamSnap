<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    protected $fillable = [
        'teams_id','users_id'
    ];


    public $timestamps = false;

    public static function members($id)
    {
    	return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->leftJoin('player_ctgs', 'player_ctgs.team_users_id', '=', 'team_users.id')
                     ->leftJoin('team_user_details', 'team_user_details.team_users_id', '=', 'team_users.id')
                     ->leftJoin('users', 'users.id', '=', 'team_users.users_id')
                     ->where('team_users.teams_id', $id)
                     ->select('user_details.*', 'users.email', 'player_ctgs.categories_id', 'team_users.id', 'team_user_details.flag', 'team_user_details.role');
    }


    //get all the users of the team with id = $id
    public static function getMembers($id)
    {
        return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->leftJoin('users', 'team_users.users_id', '=', 'users.id')
                     ->select('users.id', 'users.email', 'user_details.firstname', 'user_details.lastname')
                     ->where('team_users.teams_id', $id)
                     ->get();
    }


    public static function createTeamUser($tid, $uid)
    {
        return static::create([
                            'teams_id'  => $tid,
                            'users_id'  => $uid,
                        ]);
    }

    //get tuser id of memeber $uid of team $tid
    public static function findUID($id)
    {
        return static::find($id)->users_id;
    }
}
