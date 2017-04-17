<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use TeamSnap\TeamUser;

class BaseballRecord extends Model
{
    //

    protected $fillable = [
         'team_user_id', 'game_team_id','at_bats','runs', 'hits', 'doubles','triples','home_runs', 'runs_batted_in', 'bases_on_balls','strike_outs','stolen_bases', 'caught_stealing', 'hit_by_pitch', 'sacrifice_flies', 'singles'
    ];


    public $timestamps = false;

    public static function getPlayerGameStats($uid, $gid)
    {
    	return static::where('game_team_id', $gid)->where('team_user_id', $uid)->get();
    }

    public static function getRecords($tid, $id)
    {
    	$user = TeamUser::where('teams_id', $tid)
                        ->leftJoin('team_user_details', 'team_user_details.team_users_id', 'team_users.id')
                        ->where('team_user_details.flag', 1)
                        ->select('team_users.id')
                        ->get();

        return static::where('game_team_id', $id)
        			 ->whereIn('team_user_id', $user->toArray())
        			 ->get();
    }
}
