<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use \TeamSnap\TeamUser;
use \TeamSnap\UserDetail;
use Auth;
use \TeamSnap\Repositories;
use TeamSnap\User;

class DashboardController extends Controller
{

   public function index($id)
    {
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();
      $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
      $manager = Team::where('team_owner_id', $uid)->where('id', $id)->first();

      if( $manager != '' )
      {
        return view('dashboard', [ 'teamname' => $manager->teamname, 'id' => $id] );
      }
      else if( $member != '' )
      {
        $tname = Team::find($id)->teamname;
        return view('dashboard', [ 'teamname' => $tname, 'id' => $id] );
      }
      else
      {
        return view('errors/404');
      }
    }
}
