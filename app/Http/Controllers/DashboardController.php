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
       $team_name = Team::where('team_owner_id',$user_id)->value('teamname');
       if($team_name == '' || $team_name== NULL)
       {
       	return view('errors/404');
       }
       else
       {
        return view('dashboard', [ 'teamname' => $id, ] );
       }
    }
}
