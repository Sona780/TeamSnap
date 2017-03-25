<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\UserDetail;

class TeamController extends Controller
{
    //
    public function getAll()
    {
        $uid     = Auth::user()->id;
        $manager = UserDetail::where('users_id', $uid)->first()->manager_access;

        if( $manager == 1 )
    	   return Team::where('team_owner_id', Auth::user()->id)->get();
        else
           return TeamUser::getUserTeams($uid);
    }

    public function get(Request $req)
    {
    	return $req->file('file');
    }

    public function getMemberTeams()
    {
    	$uid   = Auth::user()->id;
    	$teams = TeamUser::where('users_id', $uid)->leftJoin('teams', 'teams.id', 'team_users.teams_id')->select('teams.id', 'teams.teamname')->get();
    	dd($teams);
    	return $teams;
    }
}
