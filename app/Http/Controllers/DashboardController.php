<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use \TeamSnap\UserDetail;
use Auth;
use \TeamSnap\Repositories;
use TeamSnap\User;

class DashboardController extends Controller
{

   public function index($id)
    {

        $user_id = Auth::user()->id;
        $team_logo = Team::where('teamname', $id)->first()->team_logo;
        //Total Members in Team
        // $noofmembers = User::where('team_name', $id)->count();

        return view('dashboard', [ 'teamname' => $id, 'team_logo' => $team_logo] );

    }
}
