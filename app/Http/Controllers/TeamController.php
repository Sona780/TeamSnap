<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;

class TeamController extends Controller
{
    //
    public function getAll()
    {
    	return Team::where('team_owner_id', Auth::user()->id)->get();
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
