<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use \TeamSnap\Member;
use Auth;
use \TeamSnap\Repositories;

class DashboardController extends Controller
{

   public function index($id)
    {

      $teamname = app('MyRepository')->getTeamName(1);
      dd($teamname);

        $user_id = Auth::user()->id;

        //Total Members in Team
        //$noofmembers = Member::where('team_name', $team_name)->count();

        return view('dashboard', [ 'teamname' => 'a', 'noofmembers' => 1 ] );

    }
}
