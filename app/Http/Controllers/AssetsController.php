<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\TeamUser;
use TeamSnap\Asset;
use TeamSnap\Game;

class AssetsController extends Controller
{
    // show current availability of team members
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
    		$gid = Asset::where('team_users_id', $pid)->select('games_id')->get();

    		foreach ($gid as $g)
    			$pgame[$pid][$g->games_id] = 'yes';
    	}

    	foreach ($staffs as $staff)
    	{
    		$sid = $staff->id;
    		$gid = Asset::where('team_users_id', $sid)->select('games_id')->get();

    		foreach ($gid as $g)
    			$sgame[$sid][$g->games_id] = 'yes';
    	}

    	return view('pages.assets', compact('id', 'games', 'players', 'staffs', 'pgame', 'sgame'));
    }

    public function update(Request $request)
    {
    	$tuid = $request->tuid;
    	$gid  = $request->gid;

    	if( $request->ch == 1 )
	    	Asset::newAsset($tuid, $gid);
	    else
	    	Asset::deleteAsset($tuid, $gid);
    }
}
