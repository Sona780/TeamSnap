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
use TeamSnap\League;
use TeamSnap\LeagueTeam;
use TeamSnap\LeagueAnnouncement;

use TeamSnap\Http\ViewComposer\UserComposer;

class DashboardController extends Controller
{

   public function index($id)
    {
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();
      $member  = TeamUser::CheckMembership($id, $uid)->first();
      $owner   = Team::CheckIfTeamOwner($uid, $id)->first();
      $team    = Team::find($id);
      $type    = 'team';

      $composerWrapper = new UserComposer( $id, 'team' );
      $composerWrapper->compose();

      $manager = '';
      if( $user->manager_access == 2 )
        $manager = TeamUser::CheckMembership($id, $uid)->first();

      if( $owner != '' || $manager != '' )
      {
        $teamname = Team::find($id)->teamname;
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

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user', 'type'));
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

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user', 'type'));
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

    public function leagueDashboard($id)
    {
      $user   = Auth::user();
      $uid    = $user->id;
      $ch  = League::find($id)->user_id;

      if( $uid != $ch )
        return view('errors/404');

      $league = League::find($id);
      $type   = 'league';
      $league->team_logo = '';

      $composerWrapper = new UserComposer($id, 'league');
      $composerWrapper->compose();

      $total    = [];
      $total['teams']   = League::totalTeams($id);
      $total['matches'] = League::totalMatches($id);
      $total['played']  = League::playedMatches($id);
      $total['future']  = $total['matches'] - $total['played'];


      $matches   = League::matches($id);

      foreach ($matches as $match)
      {
        if( $match->minute < 10 )
          $match->minute = '0'.$match->minute;
        $match->time = ($match->time == 0) ? 'AM' : 'PM';
        $match->team_name = LeagueTeam::find($match->team1)->team_name;
        $match->opponent  = LeagueTeam::find($match->team2)->team_name;
      }

      $announcements = LeagueAnnouncement::where('league_id', $id)->latest('id')->get();

      return view('league.dashboard', compact('id', 'league', 'total', 'matches', 'announcements', 'user', 'type'));
    }

    public function saveLeagueAnnouncement($id, Request $request)
    {
      $request['league_id'] = $id;
      LeagueAnnouncement::create($request->all());
    }
}
