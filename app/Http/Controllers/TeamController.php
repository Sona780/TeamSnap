<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\UserDetail;
use TeamSnap\AllGame;

use Image;

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
    	return $teams;
    }

    public function edit($tid)
    {
        $team  = Team::find($tid);
        $uid   = Auth::user()->id;

        if( $team == '' || $uid != $team->team_owner_id )
            return view('errors/404');

        $gms   = AllGame::all();

        $games = [];
        foreach ($gms as $g)
            $games[$g->id] = $g->game_name;

        return view('pages.edit-team', compact('games', 'team', 'tid'));
    }

    public function update(Request $request)
    {
        $team = Team::find($request->id);
        if( $request->hasFile('logo') )
        {
            $teamlogo = $request->file('logo');
            $filename = time().'.'.$teamlogo->getClientOriginalExtension();
            $path     = '/images/teams/'.$filename;

            Image::make($teamlogo)->resize(300,300)->save(config('paths.public_html').$path);

            $request['team_logo'] = $path;
        }

        $team->update($request->all());

        return redirect('home');
    }

    public function delete($tid)
    {
        Team::find($tid)->delete();

        return redirect('home');
    }
}
