<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use \TeamSnap\Member;
use Auth;

class DashboardController extends Controller
{

   public function index($id, Request $request)
    {
        $team_name = \Request::get('team_name');
        $user_id = Auth::user()->id;

        //Total Members in Team
        $noofmembers = Member::where('team_name', $team_name)->count();

        return view('dashboard', [ 'teamname' => $team_name, 'noofmembers' => $noofmembers ] );

    }
}
