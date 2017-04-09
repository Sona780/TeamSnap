<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use \TeamSnap\Team;
use \TeamSnap\TeamUser;
use \TeamSnap\UserDetail;
use Auth;
use \TeamSnap\Repositories;
use TeamSnap\User;
use TeamSnap\Event;
use TeamSnap\Game;
use TeamSnap\Announcement;
use TeamSnap\TeamInfo;

class DashboardController extends Controller
{

   public function index($id)
    {
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();
      $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
      $manager = Team::CheckIfTeamOwner($uid, $id)->first();
      $team    = Team::find($id);

      if( $manager != '' )
      {
        $teamname = $manager->teamname;
        $total    = [];

        $total['members']      = TeamUser::where('teams_id', $id)->count();
        $total['events']       = Event::Events($id)->count();
        $total['games']        = Game::FutureGames($id)->count();
        $total['games_played'] = Game::PlayedGames($id)->count();

        $games = Game::where('users_id', $uid)->where('teams_id', $id)->orderBy('updated_at', 'latest')->get();
        $games = ScheduleController::getTeamGames($games);

        $events = Event::where('users_id', $uid)->where('teams_id', $id)->orderBy('updated_at', 'latest')->get();
        $events = ScheduleController::getTeamEvents($events);
        $announcements = $this->getAnnouncements($id);

        $info = TeamInfo::where('team_id', $id)->first();

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user'));
      }
      else if( $member != '' )
      {
        $teamname = $member->teamname;
        $total    = [];

        $games  = Game::PlayerFutureGames($id, $member->id)->get();

        $total['members']      = TeamUser::where('teams_id', $id)->count();
        $total['events']       = Event::Events($id)->count();
        $total['games']        = $games->count();
        $total['games_played'] = Game::PlayerPlayedGames($id, $member->id)->count();

        $events = Event::where('teams_id', $id)->orderBy('updated_at', 'latest')->get();
        $events = ScheduleController::getTeamEvents($events);
        $announcements = $this->getAnnouncements($id);

        $info = TeamInfo::where('team_id', $id)->first();

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user'));
      }
      else
      {
        return view('errors/404');
      }
    }

    public function saveAnnouncement($id, Request $request)
    {
      $request['team_id'] = $id;
      Announcement::create($request->all());

      //return $this->getAnnouncements($id);
    }

    public function getAnnouncements($id)
    {
      return Announcement::where('team_id', $id)->orderBy('id', 'desc')->get();
    }
}
