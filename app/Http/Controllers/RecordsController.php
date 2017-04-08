<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Stat;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\Availability;
use TeamSnap\BaseballRecord;
use TeamSnap\Game;

use DB;

class RecordsController extends Controller
{

    public function getStats($stats)
    {
      $stat = [];

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

      $num = $stat['singles'] * 1 + $stat['doubles'] * 2 + $stat['triples'] * 3 + $stat['home_runs'] * 4;
      $den = $stat['at_bats'];

      $stat['average'] = $this->computeResult($stat['hits'], $den);
      $stat['slg']     = $this->computeResult($num, $den);

      $num = $stat['hits'] + $stat['bases_on_balls'] + $stat['hit_by_pitch'];
      $den = $stat['at_bats'] + $stat['bases_on_balls'] + $stat['hit_by_pitch'] + $stat['sacrifice_flies'];

      $stat['obp']     = $this->computeResult($num, $den);

      return $stat;
    }

    public function computeResult($num, $den)
    {
      if($den > 0)
        return number_format((float)$num/$den, 3, '.', '');
      return 0;
    }

    // start show player stats
    public function show($id)
    {
      $team = Team::find($id);

      if( $team->all_games_id == 1 )
      {
        // start total stats of ecah player
          $players = TeamUser::getTeamPlayers($id, 1);

          foreach ($players as $player)
          {
            $stats         = $player->baseballRecord();
            $player->stat  = $this->getStats($stats);
            $player->games = Availability::getBaseballOpponentsCount($player->id);
            $player->name  = $player->firstname.' '.$player->lastname;
          }

          $players = $players->sortBy(function($player){
            return $player->stat['average'];
          })->reverse();
        // end total stats of ecah player

        // start total stats of ecah player
          $games = Game::getTeamPlayedGames($id);

          $gpstats = [];
          $i = 0;

          foreach ($games as $game)
          {
            $stats = $game->baseballRecord();

            $gpstats[$i]['game']['id']      = $game->id;
            $gpstats[$i]['game']['name']    = $game->name;
            $gpstats[$i]['game']['results'] = $game->results;

            $game->stat = $this->getStats($stats);
            $stats = $stats->get();

            $temp = [];
            $j = 0;
            foreach ($stats as $stat)
            {
              $pdata = TeamUser::getUserDetail($stat->team_user_id);

              $num = $stat->singles * 1 + $stat->doubles * 2 + $stat->triples * 3 + $stat->home_runs * 4;
              $den = $stat['at_bats'];

              $stat->average = $this->computeResult($stat['hits'], $den);
              $stat->slg     = $this->computeResult($num, $den);

              $num = $stat->hits + $stat->bases_on_balls + $stat->hit_by_pitch;
              $den = $stat->at_bats + $stat->bases_on_balls + $stat->hit_by_pitch + $stat->sacrifice_flies;

              $stat->obp     = $this->computeResult($num, $den);

              $pdata->stat  = $stat;
              $pdata->name  = $pdata->firstname.' '.$pdata->lastname;
              $temp[$j++] = $pdata;
            }

            $gpstats[$i]['stats'] = $temp;

            $i++;
          }

          //return $gpstats;

          $games = $games->sortBy(function($game){
            return $game->stat['average'];
          })->reverse();

          //return $gpstats[0];
        // end total stats of ecah player


        return view('records.baseball', compact('id', 'team', 'players', 'games', 'gpstats'));
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
