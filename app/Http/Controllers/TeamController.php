<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Team;

class TeamController extends Controller
{
    //
    public function getAll()
    {
    	return Team::where('team_owner_id', Auth::user()->id)->get();
    }
}
