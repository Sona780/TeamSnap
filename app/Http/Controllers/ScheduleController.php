<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Event;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\Team;
use TeamSnap\League;
use TeamSnap\LeagueTeam;
use TeamSnap\LeagueLocation;
use TeamSnap\LeagueMatchDetail;
use TeamSnap\LeagueDivision;
use TeamSnap\DivisionManager;

use TeamSnap\GameTeam;
use TeamSnap\GameDetail;
use TeamSnap\OpponentDetail;
use TeamSnap\LocationDetail;
use TeamSnap\Availability;
use TeamSnap\AccessManage;
use TeamSnap\CustomField;

use Auth;
use Carbon\Carbon;
use Redirect;

use TeamSnap\Http\ViewComposer\UserComposer;
use TeamSnap\Http\Controllers\DashboardController;

class ScheduleController extends Controller
{

    public function getGames($id, $games)
    {
        $res = [];
        $i = 0;
        foreach ($games as $game)
        {
            $opp_id = ( $game->team1_id == $id ) ? $game->team2_id : $game->team1_id;

            $res[$i]['id']       = $game->id;
            $res[$i]['type']     = $game->game_type;
            $res[$i]['opp']      = Team::getDetail($opp_id);

            if( $res[$i]['type'] == 0 )
            {
                $res[$i]['detail']   = GameDetail::getDetail($game->id);
                $res[$i]['loc']      = LocationDetail::find($res[$i]['detail']->location_detail_id);
                $res[$i]['opp_data'] = ($game->team1_id == $id) ? OpponentDetail::getDetail($id) : '';
                $res[$i]['ch']       = ($game->team1_id == $id) ? 'yes' : 'no';
            }
            else
            {
                $res[$i]['detail']   = LeagueMatchDetail::getDetail($game->id);
                $res[$i]['loc']      = LeagueLocation::find($res[$i]['detail']->league_location_id);
                $res[$i]['ch']       = 'no';

                $res[$i]['detail']['time'] = ($res[$i]['detail']['time'] == 0) ? 'AM' : 'PM';
            }

            $min = $res[$i]['detail']->minute;
            if( $min < 10 )
                $res[$i]['detail']->minute = '0'.$min;

            $i++;
        }
        return collect($res);
    }

    // start show team schedule
    public function get($id)
    {
        //get user id
        $uid     = session('id') ? session('id') : Auth::user()->id;
        $user    = UserDetail::where('users_id', $uid)->first();
        $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
        $owner   = Team::CheckIfTeamOwner($uid, $id)->first();
        $manager = ( $user->manager_access == 2 ) ? TeamUser::where('teams_id', $id)->where('users_id', $uid)->first() : '';
        $access  = AccessManage::getDetail($id);

        $composerWrapper = new UserComposer( $id, 'team' );
        $composerWrapper->compose();

        if( $owner != '' || ($manager != '' && $access->schedule == 1) )
        {
            //get all scheduled games for team
            $games = $this->getGames($id, GameTeam::getGames($id));
            //return $games;

            //get all scheduled events for team
            $events = Event::where('team_id', $id)->orderBy('updated_at', 'latest')->get();
            $events = $this->getTeamEvents($events);

            //get all the opponents of the team
            $opp = GameTeam::getOpponents($id);

            //get all the locations of games for the team
            $game_loc  = LocationDetail::getLocations($id, 0);     //for game type = 0

            //fget all the locations of events for the team
            $event_loc = LocationDetail::getLocations($id, 1);     //for event type = 1

            $team   = Team::find($id);
            $fields = $team->fields()->get();
            foreach ($fields as $field)
              $field->field_options = explode(",", $field->field_options);
            //return $fields;

            return view('pages.team-schedule', compact('games', 'events', 'id', 'opp', 'game_loc', 'event_loc', 'team', 'user', 'fields'));
        }
        else if( $user->manager_access == 0 && $member != '' )
        {
            $tuid    = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first()->id;

            //get all scheduled games for team
            $tuid  = TeamUser::where('teams_id', $id)->where('users_id', $uid)->first()->id;
            $games = $this->getGames($id, Availability::PlayerGames($tuid)->get());

            //get all scheduled events for team
            $events = Event::where('team_id', $id)->latest('updated_at')->get();
            $events = $this->getTeamEvents($events);

            $team  = Team::find($id);

            return view('pages.team-schedule', compact('games', 'events', 'id', 'team', 'user'));
        }
        else
            return view('errors/404');
    }
    // end show team schedule

    public static function getTeamGames($games)
    {
        //get opponent & location details for all scheduled games for team
        foreach ($games as $game) {
            if( $game->minute < 10 )
                $game->minute = '0'. $game->minute;

            $game->name = Opponent::find($game->opponents_id)->name;
            $game->location = Location::find($game->locations_id);
        }

        return $games;
    }

    public static function getTeamEvents($events)
    {
        //get location details for all scheduled events for team
        foreach ($events as $event) {
            if( $event->minute < 10 )
                $event->minute = '0'. $event->minute;

            $event->location = LocationDetail::find($event->location_detail_id);
        }

        return $events;
    }

    public function getChilds($id, $arr)
    {
        $i = sizeof($arr);
        $childs = LeagueDivision::childDivs($id);
        if( $childs->count() == 0 )
        {
          $arr[$i] = LeagueDivision::find($id);
          return $arr;
        }
        foreach ($childs as $child)
          $arr = $this->getChilds($child->id, $arr);
        return $arr;
    }

    public function showLeague($id, $ldid)
    {
        $user = Auth::user();
        $uid  = session('id') ? session('id') : Auth::user()->id;
        $ch   = League::find($id)->user_id;
        $man  = DivisionManager::check($uid, $ldid);

        if( $uid != $ch && $man == 0 )
          return view('errors/404');

        $composerWrapper = new UserComposer( $id, 'league' );
        $composerWrapper->compose();

        $div = [];
        $div['teams'] = LeagueTeam::getTeams($ldid);
        $div['locs']  = LeagueLocation::divisionLocations($ldid);
        $div['child'] = $this->getChilds($ldid, []);
        //return $div['child'];

        $matches   = LeagueMatchDetail::matches($ldid);
        $league    = League::find($id);

        foreach ($matches as $match)
        {
            if( $match->minute < 10 )
                $match->minute = '0'.$match->minute;

            $match->time      = ($match->time == 0) ? 'AM' : 'PM';
            $match->team_name = Team::find($match->team1_id)->teamname;
            $match->div1      = LeagueTeam::getTeamDiv($match->team1_id, $id);
            $match->opponent  = Team::find($match->team2_id)->teamname;
            $match->div2      = LeagueTeam::getTeamDiv($match->team2_id, $id);
        }

        $d = new DashboardController();
        $prev = $d->path($ldid);
        $curr = LeagueDivision::find($ldid)->division_name;

        return view('league.schedule', compact('id', 'league', 'matches', 'ldid', 'prev', 'curr', 'div'));
    }

    public function saveLeagueMatch($id, $ldid, Request $request)
    {
        //return $request->team2_id;
        $return['game_type'] = 1;
        $gteam = GameTeam::newGame($request->team1_id, $request->team2_id, 1);

        $request['league_id'] = $id;
        $loc = $request->location;
        if( $loc == 'new' )
        {
            $loc = LeagueLocation::create($request->all());
            $loc = $loc->id;
        }
        $request['league_location_id'] = $loc;
        $request['game_team_id'] = $gteam->id;
        $m = LeagueMatchDetail::create($request->all());

        session()->flash('success', 'The match has been scheduled successfully!!');
        return Redirect::back();
    }

    public function editLeagueMatch($id, $ldid, Request $request)
    {
        $mid = $request->mid;
        $loc = $request->location;
        if( $loc == 'new' )
        {
            $loc = LeagueLocation::create($request->all());
            $loc = $loc->id;
        }
        LeagueMatchDetail::matchUpdate($request, $loc);
        session()->flash('success', 'The scheduled match detail has been updated successfully!!');
        return redirect("l/$id/d/$ldid/schedule");
    }

    public function deleteLeagueMatch($id, $ldid, $mid)
    {
        GameTeam::find($mid)->delete();
        session()->flash('success', 'The match has been deleted successfully!!');
        return Redirect::back();
    }

    public function getLeagueMatchDetail($id, $ldid, $gtid)
    {
        $gt = GameTeam::find($gtid);
        $data = [];
        $data['t1'] = Team::find($gt->team1_id)->teamname;
        $data['t2'] = Team::find($gt->team2_id)->teamname;
        $data['detail'] = LeagueMatchDetail::getDetail($gtid);
        return $data;
    }
}
