<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\TeamUser;
use TeamSnap\Availability;
use TeamSnap\Game;
use TeamSnap\Team;

class AvailabilityController extends Controller
{
    public function show($id)
    {
    	$players = TeamUser::getTeamPlayers($id, 1);
    	$staffs  = TeamUser::getTeamPlayers($id, 0);

    	$games   = Game::getTeamGames($id);

    	$pgame   = [];
    	$sgame   = [];

    	foreach ($players as $player)
    	{
    		$pid = $player->id;

    		$gid = Availability::where('team_users_id', $pid)->select('games_id')->get();

    		foreach ($gid as $g)
    			$pgame[$pid][$g->games_id] = 'yes';
    	}

    	foreach ($staffs as $staff)
    	{
    		$sid = $staff->id;
    		$gid = Availability::where('team_users_id', $sid)->select('games_id')->get();

    		foreach ($gid as $g)
    			$sgame[$sid][$g->games_id] = 'yes';
    	}

        $team  = Team::find($id);

    	return view('pages.availability', compact('id', 'games', 'players', 'staffs', 'pgame', 'sgame', 'team'));
    }

    public function update(Request $request)
    {
    	$tuid = $request->tuid;
    	$gid  = $request->gid;

    	if( $request->ch == 1 )
	    	Availability::newAvailability($tuid, $gid);
	    else
	    	Availability::deleteAvailability($tuid, $gid);
    }
}
