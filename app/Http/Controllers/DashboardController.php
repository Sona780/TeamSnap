<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use \Org4Leagues\Team;
use \Org4Leagues\TeamUser;
use \Org4Leagues\UserDetail;
use Auth;
use \Org4Leagues\Repositories;
use Org4Leagues\User;
use Org4Leagues\Event;
use Org4Leagues\Announcement;
use Org4Leagues\TeamInfo;
use Org4Leagues\League;
use Org4Leagues\LeagueTeam;
use Org4Leagues\LeagueAnnouncement;
use Org4Leagues\Availability;
use Org4Leagues\GameDetail;
use Org4Leagues\GameTeam;
use Org4Leagues\LeagueMatchDetail;
use Org4Leagues\LeagueDivision;
use Org4Leagues\DivisionManager;
use Redirect;


use Org4Leagues\Http\ViewComposer\UserComposer;

class DashboardController extends Controller
{
  // start team dashboard
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

      if( $user->manager_access == -1 || $owner != '' || $manager != '' )
      {
        $teamname = Team::find($id)->teamname;
        $total    = [];
        $games = [];
        $i = 0;

        $all_games = GameTeam::getGames($id);
        //return $all_games;

        foreach ($all_games as $g)
        {
          if( $g->game_type == 0 )
          {
            $detail = GameDetail::getDetail($g->id);
            $date   = Carbon::createFromFormat('d/m/Y', $detail->date)->format('d/m/Y');
          }
          else
          {
            $detail = LeagueMatchDetail::where('game_team_id', $g->id)->first();
            $date   = Carbon::createFromFormat('d/m/Y', $detail->match_date)->format('d/m/Y');
          }

          if( $date >= Carbon::now()->format('d/m/Y') )
          {
            $opp_id = ($g->team1_id == $id) ? $g->team2_id : $g->team1_id;

            $games[$i]['id']     = $g->id;
            $games[$i]['on']     = $date;
            $games[$i]['hour']   = $detail->hour;
            $games[$i]['minute'] = $detail->minute;
            $games[$i]['time']   = $detail->time;
            $games[$i]['opp']    = Team::find($opp_id)->teamname;
            $i++;
          }
        }

        $total['members']      = TeamUser::where('teams_id', $id)->count();
        $total['events']       = Event::Events($id)->count();
        $total['games']        = $i;
        $total['games_played'] = $all_games->count() - $i;

        $events        = Event::Events($id)->get();
        $announcements = $this->getAnnouncements($id);
        $info          = TeamInfo::where('team_id', $id)->first();

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user', 'type'));
      }
      else if( $member != '' )
      {
        $teamname = $member->teamname;
        $total    = [];

        $all_games = Availability::getPlayerGames($uid);
        $i = 0;
        $games = [];
        foreach ($all_games as $game)
        {
          $detail = GameDetail::where('game_team_id', $game->game_team_id)->first();
          $date   = Carbon::createFromFormat('d/m/Y', $detail->date)->format('d/m/Y');
          if($date >= Carbon::now()->format('d/m/Y'))
          {
            $gt = GameTeam::find($game->game_team_id);
            $opp_id = ($gt->team1_id == $id) ? $gt->team2_id : $gt->team1_id;
            $games[$i]['id']     = $gt->id;
            $games[$i]['on']     = $date;
            $games[$i]['hour']   = $detail->hour;
            $games[$i]['minute'] = $detail->minute;
            $games[$i]['name']   = Team::find($opp_id)->teamname;
            $i++;
          }
        }

        $total['members']      = TeamUser::where('teams_id', $id)->count();
        $total['events']       = Event::Events($id)->count();
        $total['games']        = $i;
        $total['games_played'] = $all_games->count() - $i;

        $events = Event::Events($id)->get();
        $announcements = $this->getAnnouncements($id);

        $info = TeamInfo::where('team_id', $id)->first();

        return view('pages.dashboard', compact('teamname', 'id', 'team', 'total', 'games', 'events', 'announcements', 'info', 'user', 'type'));
      }
      else
      {
        return view('errors/404');
      }
    }
  // end team dashboard

  // start league dashboard
    public function leagueDashboard($id, $ldid)
    {
      $user = Auth::user();
      $uid  = session('id') ? session('id') : Auth::user()->id;
      $ch   = League::find($id)->user_id;
      $man  = DivisionManager::check($uid, $ldid);

      if( $uid != $ch && $man == 0 )
        return view('errors/404');

      $league = League::find($id);
      $type   = 'league';
      $league->team_logo = '';

      $composerWrapper = new UserComposer($id, 'league');
      $composerWrapper->compose();

      $total    = [];

      $total['teams'] = LeagueTeam::totalTeams($ldid);
      $total['divs']  = LeagueDivision::totalDivs($ldid);

      $matches = LeagueMatchDetail::matches($ldid);
      $i = 0;
      foreach ($matches as $match)
      {
        $date = Carbon::createFromFormat('d/m/Y', $match->match_date)->format('d/m/Y');
        if($date >= Carbon::now()->format('d/m/Y'))
        {
          $i++;
        }
        if( $match->minute < 10 )
          $match->minute = '0'.$match->minute;
        $match->time = ($match->time == 0) ? 'AM' : 'PM';
        $match->team_name = Team::find($match->team1_id)->teamname;
        $match->opponent  = Team::find($match->team2_id)->teamname;
      }

      $total['matches'] = $matches->count();
      $total['played']  = $matches->count() - $i;
      $total['future']  = $i;

      $announcements = LeagueAnnouncement::where('league_id', $id)->latest('id')->get();
      $prev = $this->path($ldid);
      $curr = LeagueDivision::find($ldid)->division_name;


      return view('league.dashboard', compact('id', 'league', 'total', 'matches', 'announcements', 'user', 'type', 'ldid', 'prev', 'curr'));
    }
  // end league dashboard

  // start save team announcements
    public function saveAnnouncement($id, Request $request)
    {
      $request['team_id'] = $id;
      $ann = Announcement::create($request->all());
      return $ann->id;
    }
  // end save team announcements

  // start all announcements
    public function getAnnouncements($id)
    {
      return Announcement::where('team_id', $id)->orderBy('id', 'desc')->get();
    }
  // end all announcements

  // start get announcement data
    public function getAnnouncement($type, $id)
    {
      if( $type == 'league' )
        return LeagueAnnouncement::find($id);
      else
        return Announcement::find($id);
    }
  // end get announcement data

  // start update announcement
    public function editAnnouncement($type, $id, Request $request)
    {
      if( $type == 'league' )
        LeagueAnnouncement::find($id)->update($request->except('_token', 'id'));
      else
        Announcement::find($id)->update($request->except('_token', 'id'));
    }
  // end update announcement

  // start delete announcement
    public function deleteLAnnouncement($type, $aid)
    {
      if( $type == 'league' )
        LeagueAnnouncement::find($aid)->delete();
      else
        Announcement::find($aid)->delete();
      session()->flash('success', 'Announcement successfully deleted.');
      return Redirect::back();
    }
  // end delete announcement

  // start save league announcement
    public function saveLeagueAnnouncement($id, Request $request)
    {
      $request['league_id'] = $id;
      $ann = LeagueAnnouncement::create($request->all());
      return $ann->id;
    }
  // end save league announcement

  // start get league division path
    public function path($ldid)
    {
      $prev = [];
      $i = 0;
      $div = LeagueDivision::find($ldid);
      $parent = $div->parent_id;
      while($parent != 0)
      {
        $div = LeagueDivision::find($parent);
        $prev[$i]['name'] = $div->division_name;
        $prev[$i++]['id'] = $div->id;
        $parent = $div->parent_id;
      }
      return array_reverse($prev);
    }
  // end get league division path
}
