<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\Member;
use TeamSnap\Team;

class HomeController extends Controller
{
   public function index()
   {

        $uid   = Auth::user()->id;
        $user  = UserDetail::where('users_id', $uid)->first();

   		if( $user->manager_access == 1 )
   			$teams = Team::where('team_owner_id', $uid)->get();
   		else
   			$teams = TeamUser::getUserTeams($uid);

   		return view('home', compact( 'teams', 'user' ));
   }
}
