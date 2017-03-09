<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Game;
use TeamSnap\Event;
use TeamSnap\Opponent;
use TeamSnap\Location;
use Auth;

class ScheduleController extends Controller
{
    //
    public function get($id)
    {
    	$games = Game::where('user_id', Auth::user()->id)->where('team_id', $id)->orderBy('updated_at', 'latest')->get();
    	$events = Event::where('user_id', Auth::user()->id)->where('team_id', $id)->orderBy('updated_at', 'latest')->get();
    	//return $games." ".$events;
    	foreach ($games as $game) {
    		if( $game->minute < 10 )
    			$game->minute = '0'. $game->minute;

            $game->name = Opponent::find($game->opponent_id)->name;
            $game->location = Location::find($game->location_id);
    	}
    	foreach ($events as $event) {
    		if( $event->minute < 10 )
    			$event->minute = '0'. $event->minute;

            $event->location = Location::find($event->location_id);
    	}

        $opp = Opponent::where('team_id', $id)->get();
        $game_loc = Location::where('team_id', $id)->where('type', 0)->get();       //for game type = 0
        $event_loc = Location::where('team_id', $id)->where('type', 1)->get();      //for event type = 1
        //return $opp;
    	return view('pages.team-schedule', compact('games', 'events', 'id', 'opp', 'game_loc', 'event_loc'));
    }
}
