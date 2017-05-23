<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\Member;
use TeamSnap\Team;
use TeamSnap\User;
use TeamSnap\LeagueDivision;
use TeamSnap\DivisionManager;

class HomeController extends Controller
{
   public function index()
   {
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();
      $leagues = User::find(Auth::user()->id)->leagues()->get();
      foreach ($leagues as $league)
         $league->ldid = LeagueDivision::where('league_id', $league->id)->first()->id;
      //return $leagues;

      switch($user->manager_access) {
         case 0:
            $teams = TeamUser::getUserTeams($uid);
            break;
         case 1:
            $teams = Team::where('team_owner_id', $uid)->get();
            break;
         case 2:
            $teams   = TeamUser::getManagerTeams($uid);
            $leagues = DivisionManager::geDivisions($uid);
            break;
      }
      //return $leagues;

   	return view('pages.home', compact( 'teams', 'user', 'leagues'));
   }
}
