<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Org4Leagues\UserDetail;
use Org4Leagues\TeamUser;
use Org4Leagues\Member;
use Org4Leagues\Team;
use Org4Leagues\League;
use Org4Leagues\User;
use Org4Leagues\LeagueDivision;
use Org4Leagues\DivisionManager;

class HomeController extends Controller
{
   public function index()
   {
      $aid  = Auth::user()->id;
      $uid  = ( session('id') ) ? session('id') : $aid;
      $user = UserDetail::where('users_id', $uid)->first();

      if( $user->manager_access == -1 )
         return view('errors.404');


      $leagues = User::find($uid)->leagues()->get();
      foreach ($leagues as $league)
         $league->ldid = LeagueDivision::where('league_id', $league->id)->first()->id;

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

   	return view('pages.home', compact( 'teams', 'user', 'leagues', 'aid'));
   }
}
