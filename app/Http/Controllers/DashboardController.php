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

        $user_id = Auth::user()->id;

        //Get Team name
        $team_name = Member::where('user_id', $user_id)->select('team_name')->get()->first();
        $team_name = $team_name->team_name;

        //Total Members in Team
        $noofmembers = Member::where('team_name', $team_name)->count();

        return view('dashboard', [ 'teamname' => $team_name, 'noofmembers' => $noofmembers ] );

    }
}
