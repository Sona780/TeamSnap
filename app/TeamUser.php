<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    protected $fillable = [
        'teams_id','users_id'
    ];


    public $timestamps = false;


    public function baseballRecord()
    {
        return $this->hasMany('TeamSnap\BaseballRecord');
    }

    public static function scopeCheckMembership($query, $tid, $uid)
    {
        $query->where('teams_id', $tid)->where('users_id', $uid);
    }

    public static function checkIfManager($id, $uid)
    {
        return static::where('teams_id', $id)->where('users_id', $uid)->first();
    }

    // get details & categories of all the members of a team
    public static function members($id)
    {
    	return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->leftJoin('player_ctgs', 'player_ctgs.team_users_id', '=', 'team_users.id')
                     ->leftJoin('team_user_details', 'team_user_details.team_users_id', '=', 'team_users.id')
                     ->leftJoin('users', 'users.id', '=', 'team_users.users_id')
                     ->where('team_users.teams_id', $id)
                     ->select('user_details.*', 'users.email', 'player_ctgs.categories_id', 'team_users.id', 'team_user_details.flag', 'team_user_details.role');
    }

    public static function getMembersByFlag($id, $flag)
    {
        return static::members($id)->where('flag', $flag)->groupBy('users.id')->get();
    }

    public static function getMembersByCat($id, $cid)
    {
        return static::members($id)->where('player_ctgs.categories_id', $cid);
    }


    //get all the users of the team with id = $id
    public static function getMembers($id)
    {
        return static::getTeamUsers($id)->get();
    }

    // create new team & user relation
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


    // get details of all the members of a team
    public static function getMemberDetails($id)
    {
        return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->select('team_users.users_id AS id', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar')
                     ->where('team_users.teams_id', $id)
                     ->get();
    }


    // get all players belongs to team
    public static function getTeamPlayers($id, $ch)
    {
        return static::where('teams_id', $id)
                     ->leftJoin('team_user_details', 'team_user_details.team_users_id', 'team_users.id')
                     ->where('team_user_details.flag', $ch)
                     ->leftJoin('user_details', 'user_details.users_id', 'team_users.users_id')
                     ->select('team_users.id', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar', 'team_user_details.role')
                     ->get();
    }

    // get all the teams of a member
    public static function getUserTeams($uid)
    {
        return static::where('users_id', $uid)
                     ->leftJoin('teams', 'teams.id', 'team_users.teams_id')
                     ->select('teams.*')
                     ->get();
    }

    public static function getUserDetail($tuid)
    {
        return static::where('team_users.id', $tuid)
                     ->leftJoin('user_details', 'user_details.users_id', 'team_users.users_id')
                     ->leftJoin('team_user_details', 'team_user_details.team_users_id', 'team_users.id')
                     ->select('team_users.id', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar', 'team_user_details.role')
                     ->first();
    }

    public static function getManagers($tid)
    {
        return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->leftJoin('users', 'team_users.users_id', '=', 'users.id')
                     ->select('team_users.id', 'users.email', 'user_details.firstname', 'user_details.lastname')
                     ->where('team_users.teams_id', $tid)
                     ->where('user_details.manager_access', 2)
                     ->get();
    }

    public static function getTeamUsers($id)
    {
        return static::leftJoin('user_details', 'team_users.users_id', '=', 'user_details.users_id')
                     ->leftJoin('users', 'team_users.users_id', '=', 'users.id')
                     ->select('users.id', 'users.email', 'user_details.firstname', 'user_details.lastname')
                     ->where('team_users.teams_id', $id);
    }

    public static function getManagerTeams($uid)
    {
        return static::where('users_id', $uid)
                     ->leftJoin('teams', 'teams.id', 'team_users.teams_id')
                     ->select('teams.*')
                     ->get();
    }
}
