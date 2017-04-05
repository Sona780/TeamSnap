<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;

use \TeamSnap\Team;
use \TeamSnap\TeamUser;
use \TeamSnap\UserDetail;
use Auth;
use \TeamSnap\Repositories;
use TeamSnap\User;
use TeamSnap\Event;
use TeamSnap\Game;

class DashboardController extends Controller
{

   public function index($id)
    {
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();
      $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
      $manager = Team::where('team_owner_id', $uid)->where('id', $id)->first();
      $team    = Team::find($id);

      if( $manager != '' )
      {
        $teamname = $manager->teamname;
        $total    = [];

        $total['members']      = TeamUser::where('teams_id', $id)->count();
        $total['events']       = Event::where('teams_id', $id)->where('date', '>=', Carbon::now())->count();
        $total['games']        = Game::where('teams_id', $id)->where('date', '>=', Carbon::now())->count();
        $total['games_played'] = Game::where('teams_id', $id)->where('date', '<', Carbon::now())->count();

        return view('dashboard', compact('teamname', 'id', 'team', 'total'));
      }
      else if( $member != '' )
      {
        return view('dashboard', [ 'teamname' => $team->teamname, 'id' => $id, 'team' => $team] );
      }
      else
      {
        return view('errors/404');
      }
    }
}
