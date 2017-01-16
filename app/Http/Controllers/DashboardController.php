<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use \TeamSnap\Member;
use Auth;

class DashboardController extends Controller
{

   public function index($id)
    {
        //Get Team name
        $user_id = Auth::user()->id;
        $team_name = Member::where('user_id', $user_id)->select('team_name')->get()->first();
        return view('dashboard')->with('teamname', $team_name->team_name);

    }
}
