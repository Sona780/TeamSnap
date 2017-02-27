<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Game;
use TeamSnap\Event;
use Auth;

class ScheduleController extends Controller
{
    //
    public function get()
    {
    	$games = Game::where('user_id', Auth::user()->id)->orderBy('updated_at', 'latest')->get();
    	$events = Event::where('user_id', Auth::user()->id)->orderBy('updated_at', 'latest')->get();
    	//return $games." ".$events;
    	return view('pages.team-schedule', compact('games', 'events'));
    }
}
