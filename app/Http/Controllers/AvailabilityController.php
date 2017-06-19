<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;

use Org4Leagues\TeamUser;
use Org4Leagues\Availability;
use Org4Leagues\Team;
use Org4Leagues\UserDetail;


use Org4Leagues\GameTeam;
use Org4Leagues\GameDetail;
use Org4Leagues\LeagueMatchDetail;
use Carbon\Carbon;
use Org4Leagues\AccessManage;

use Auth;

use Org4Leagues\Http\ViewComposer\UserComposer;

class AvailabilityController extends Controller
{
    public function show($id)
    {
        $uid    = session('id') ? session('id') : Auth::user()->id;
        $user   = UserDetail::where('users_id', $uid)->first();
        $owner  = Team::find($id)->team_owner_id;
        $access = AccessManage::getDetail($id);

        $manager = '';
        if( $user->manager_access == 2 )
          $manager = TeamUser::CheckMembership($id, $uid)->first();

        if( $uid == $owner || ($manager != '' && $access->availability == 1) )
        {
            $players = TeamUser::getTeamPlayers($id, 1);
            $staffs  = TeamUser::getTeamPlayers($id, 0);

            $all_games   = GameTeam::getGames($id);
            $games = [];
            $i = 0;
            foreach ($all_games as $game)
            {
                if( $game->game_type == 0 )
                  $date = GameDetail::where('game_team_id', $game->id)->first()->date;
                else
                  $date = LeagueMatchDetail::where('game_team_id', $game->id)->first()->match_date;

                $date = Carbon::createFromFormat('d/m/Y', $date);
                if($date->format('d/m/Y') >= Carbon::now()->format('d/m/Y'))
                {
                    $opp_id = ($game->team1_id == $id) ? $game->team2_id : $game->team1_id;
                    $games[$i]['id']   = $game->id;
                    $games[$i]['on']   = $date->format('d, M Y');
                    $games[$i]['name'] = Team::find($opp_id)->teamname;
                    $i++;
                }
            }
            $games = collect(array_values(array_sort($games, function($value){
              return $value['on'];
            })));
            //return $games;

            $composerWrapper = new UserComposer( $id, 'team' );
            $composerWrapper->compose();

            $pgame   = [];
            $sgame   = [];

            foreach ($players as $player)
            {
                $pid = $player->id;
                $gid = Availability::where('team_users_id', $pid)->select('game_team_id')->get();

                foreach ($gid as $g)
                    $pgame[$pid][$g->game_team_id] = 'yes';
            }

            foreach ($staffs as $staff)
            {
                $sid = $staff->id;
                $gid = Availability::where('team_users_id', $sid)->select('game_team_id')->get();

                foreach ($gid as $g)
                    $sgame[$sid][$g->game_team_id] = 'yes';
            }

            $team  = Team::find($id);

            return view('pages.availability', compact('id', 'games', 'players', 'staffs', 'pgame', 'sgame', 'team'));
        }
        return view('errors/404');
    }

    public function update(Request $request)
    {
    	$tuid = $request->tuid;
    	$gid  = $request->gid;

    	if( $request->ch == 1 )
	    	Availability::newAvailability($tuid, $gid);
	    else
	    	Availability::deleteAvailability($tuid, $gid);
    }
}
