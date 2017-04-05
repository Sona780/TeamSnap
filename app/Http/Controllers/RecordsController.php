<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Stat;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\Availability;
use TeamSnap\BaseballRecord;

use DB;

class RecordsController extends Controller
{
    // start show player stats
    public function show($id)
    {
      $team = Team::find($id);

      if( $team->all_games_id == 1 )
      {
        $players = TeamUser::getTeamPlayers($id, 1);

        foreach ($players as $player)
        {
          $stats = $player->baseballRecord();

          $stat = [];

          $stat['games']           = Availability::getBaseballOpponentsCount($player->id);
          $stat['at_bats']         = $stats->sum('at_bats');
          $stat['runs']            = $stats->sum('runs');
          $stat['hits']            = $stats->sum('hits');
          $stat['singles']         = $stats->sum('singles');
          $stat['doubles']         = $stats->sum('doubles');
          $stat['triples']         = $stats->sum('triples');
          $stat['home_runs']       = $stats->sum('home_runs');
          $stat['runs_batted_in']  = $stats->sum('runs_batted_in');
          $stat['bases_on_balls']  = $stats->sum('bases_on_balls');
          $stat['strike_outs']     = $stats->sum('strike_outs');
          $stat['stolen_bases']    = $stats->sum('stolen_bases');
          $stat['caught_stealing'] = $stats->sum('caught_stealing');
          $stat['hit_by_pitch']    = $stats->sum('hit_by_pitch');
          $stat['sacrifice_flies'] = $stats->sum('sacrifice_flies');


          $stat['average'] = 0;
          $stat['slg'] = 0;

          if( ($stat['at_bats'] > 0) )
          {
            $stat['average'] = number_format((float)$stat['hits']/$stat['at_bats'], 3, '.', '');
            $num = $stat['singles'] * 1 + $stat['doubles'] * 2 + $stat['triples'] * 3 + $stat['home_runs'] * 4;
            $stat['slg'] = number_format((float)$num/$stat['at_bats'], 3, '.', '');
          }

          $stat['obp'] = 0;
          $den = $stat['at_bats'] + $stat['bases_on_balls'] + $stat['hit_by_pitch'] + $stat['sacrifice_flies'];

          if( $den > 0 )
          {
            $num = $stat['hits'] + $stat['bases_on_balls'] + $stat['hit_by_pitch'];
            $stat['obp'] = number_format((float)$num/$den, 3, '.', '');;
          }


          $player->stat =  $stat;
          //return $player;
        }

        $players = $players->sortBy(function($player){
          return $player->stat['average'];
        })->reverse();

        return view('records.baseball', compact('id', 'team', 'players'));
      }
    }
    // end show player stats

    // start get opponents of player whose stat not available
    public function getOpponents($tuid)
    {
      $games = Availability::getBaseballOpponents($tuid);
      return $games;
    }
    // end get opponents of player whose stat not available


    // start save new player stat
    public function save($id, Request $request)
    {
      $gid = Team::find($id)->all_games_id;

      if( $gid == 1 )
        BaseballRecord::create($request->all());

      return redirect($id.'/records');
    }
    // end save new player stat
}
