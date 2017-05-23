<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Stat;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\Availability;
use TeamSnap\BaseballRecord;
use TeamSnap\UserDetail;

use TeamSnap\GameTeam;
use TeamSnap\GameDetail;
use TeamSnap\LeagueMatchDetail;
use TeamSnap\AccessManage;


use DB;
use Auth;
use Carbon\Carbon;
use TeamSnap\Http\ViewComposer\UserComposer;

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
      $team    = Team::find($id);
      $uid     = Auth::user()->id;
      $user    = UserDetail::where('users_id', $uid)->first();

      $composerWrapper = new UserComposer( $id, 'team' );
      $composerWrapper->compose();

      if( $team->all_games_id == 1 )
      {
        return $this->showBaseballRecords($id, $team, $uid, $user);
      }
    }
    // end show player stats

    // start show baseball records
      public function showBaseballRecords($id, $team, $uid, $user)
      {
        $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
        $owner   = Team::CheckIfTeamOwner($uid, $id)->first();
        $manager = ( $user->manager_access == 2 ) ? TeamUser::where('teams_id', $id)->where('users_id', $uid)->first() : '';
        $access  = AccessManage::getDetail($id);

        if( $owner != '' || ($manager != '' && $access->record == 1) )
        {
          // start total stats of ecah player
            $players = TeamUser::getTeamPlayers($id, 1);

            foreach ($players as $player)
            {
              $stats         = $player->baseballRecord();
              $player->stat  = $this->getStats($stats);
              $player->games = $stats->count();
              $player->name  = $player->firstname.' '.$player->lastname;
            }

            $players = $players->sortBy(function($player){
              return $player->stat['average'];
            })->reverse();
          // end total stats of each player

          // start total stats of ecah player
            $games = GameTeam::getPlayedGames($id);
            $gpstats = [];
            $i = 0;

            foreach ($games as $game)
            {
              $stats  = BaseballRecord::getRecords($id, $game->id);
              $opp_id = ($game->team1_id == $id) ? $game->team2_id : $game->team1_id;

              $gpstats[$i]['game']['id']      = $game->id;
              $gpstats[$i]['game']['name']    = Team::find($opp_id)->teamname;
              $gpstats[$i]['game']['result']  = $game->result;

              $game->stat = $this->getStats($stats);
              $game->name = $gpstats[$i]['game']['name'];

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

            $games = $games->sortBy(function($game){
              return $game->stat['average'];
            })->reverse();
          // end total stats of ecah player

          return view('records.baseball', compact('id', 'team', 'players', 'games', 'gpstats', 'user'));
        }
        else if( $user->manager_access == 0 && $member != '' )
        {
          $tuid  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first()->id;
          $games = Availability::getPlayedGames($tuid);

          foreach ($games as $game)
          {
            $stats = BaseballRecord::getPlayerGameStats($tuid, $game->id);
            $opp_id = ($game->team1_id == $id) ? $game->team2_id : $game->team1_id;
            $game->name = Team::find($opp_id)->teamname;
            $game->stat = $this->getStats($stats);
          }

          $games = $games->sortBy(function($game){
            return $game->stat['average'];
          })->reverse();
          //return $games;

          return view('records.baseball', compact('id', 'team', 'games', 'user'));
        }
        else
        {
          return view('errors/404');
        }
      }
    // end show baseball records


    // start get opponents of player whose stat not available
      public function getOpponents($id, $tuid)
      {
        $all_games = Availability::getBaseballOpponents($tuid);
        $games = [];
        $i = 0;

        foreach ($all_games as $game)
        {
          if( $game->game_type == 0 )
            $date = GameDetail::where('game_team_id', $game->id)->first()->date;
          else
            $date = LeagueMatchDetail::where('game_team_id', $game->id)->first()->match_date;

          $date   = Carbon::createFromFormat('d/m/Y', $date)->format('d/m/Y');
          if( $date <= Carbon::now()->format('d/m/Y') )
          {
            $opp_id = ($game->team1_id ==  $id) ? $game->team2_id : $game->team1_id;
            $games[$i]['name'] = Team::find($opp_id)->teamname;
            $games[$i]['id']   = $game->id;
            $games[$i]['date'] = $date;
          }
        }
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
