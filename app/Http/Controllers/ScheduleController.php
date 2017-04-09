<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Game;
use TeamSnap\Event;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\Opponent;
use TeamSnap\Location;
use TeamSnap\Team;
use Auth;

class ScheduleController extends Controller
{
    // start show team schedule
    public function get($id)
    {
        //get user id
        $uid     = Auth::user()->id;
        $user    = UserDetail::where('users_id', $uid)->first();
        $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
        $manager = Team::CheckIfTeamOwner($uid, $id)->first();

        if( $manager != '' )
        {
            //get all scheduled games for team
            $games = Game::where('users_id', $uid)->where('teams_id', $id)->orderBy('updated_at', 'latest')->get();
            $games = $this->getTeamGames($games);
            //get all scheduled events for team
            $events = Event::where('users_id', $uid)->where('teams_id', $id)->orderBy('updated_at', 'latest')->get();
            $events = $this->getTeamEvents($events);
            //get all the opponents of the team
            $opp = Opponent::where('teams_id', $id)->get();
            //get all the locations of games for the team
            $game_loc = Location::where('teams_id', $id)->where('type', 0)->get();       //for game type = 0
            //fget all the locations of events for the team
            $event_loc = Location::where('teams_id', $id)->where('type', 1)->get();     //for event type = 1

            $team  = Team::find($id);

            return view('pages.team-schedule', compact('games', 'events', 'id', 'opp', 'game_loc', 'event_loc', 'team', 'user'));
        }
        else if( $member != '' )
        {
            $tuid    = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first()->id;
            //get all scheduled games for team
            $games = Game::getPlayerAllGames($id, $tuid);
            $games = $this->getTeamGames($games);

            //get all scheduled events for team
            $events = Event::where('teams_id', $id)->latest('updated_at')->get();
            $events = $this->getTeamEvents($events);

            $team  = Team::find($id);

            return view('pages.team-schedule', compact('games', 'events', 'id', 'team', 'user'));
        }
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

            $event->location = Location::find($event->locations_id);
        }

        return $events;
    }


}
