<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\GameTeam;
use TeamSnap\OpponentDetail;
use TeamSnap\LocationDetail;
use TeamSnap\GameDetail;
use TeamSnap\Team;
use TeamSnap\LeagueMatchDetail;
use TeamSnap\LeagueLocation;

use Validator;
use Auth;


class GameController extends Controller
{
    // start validation on form submit
        public function vali(Request $request)
        {
            $v = Validator::make($request->all(), [
                'date' => 'required',
                'hour' => 'required|between:1,12|numeric',
                'minute' => 'required | numeric | between: 0, 59',

                'opponent' => 'required',
                'name' => ($request->opponent == 0) ? 'required|string' : 'string',
                'contact_person' => 'string',
                'email' => 'email',
                'phone' => 'numeric',

                'location' => 'required',
                'loc_name' => ($request->location == 0) ? 'required|string' : 'string',
                'location_detail' => 'string',
                'address' => 'string',
                'link' => 'URL',

                'd_hour' => 'between:1,12|numeric',
                'd_minute' => 'numeric | between: 0, 59',
            ]);

           	$e['date'] = ( $v->errors()->has('date') ) ? $v->errors()->first('date') : '';
        	$e['hour'] = ( $v->errors()->has('hour') ) ? $v->errors()->first('hour') : '';
        	$e['minute'] = ( $v->errors()->has('minute') ) ? $v->errors()->first('minute') : '';

            $e['opponent'] = ( $v->errors()->has('opponent') ) ? $v->errors()->first('opponent') : '';
            $e['name'] = ( $v->errors()->has('name') ) ? $v->errors()->first('name') : '';
            $e['contact_person'] = ( $v->errors()->has('contact_person') ) ? $v->errors()->first('contact_person') : '';
            $e['email'] = ( $v->errors()->has('email') ) ? $v->errors()->first('email') : '';
        	$e['phone'] = ( $v->errors()->has('phone') ) ? $v->errors()->first('phone') : '';

            $e['location'] = ( $v->errors()->has('location') ) ? $v->errors()->first('location') : '';
            $e['loc_name'] = ( $v->errors()->has('loc_name') ) ? $v->errors()->first('loc_name') : '';
            $e['location_detail'] = ( $v->errors()->has('location_detail') ) ? $v->errors()->first('location_detail') : '';
            $e['address'] = ( $v->errors()->has('address') ) ? $v->errors()->first('address') : '';
            $e['link'] = ( $v->errors()->has('link') ) ? $v->errors()->first('link') : '';

        	$e['d_hour'] = ( $v->errors()->has('d_hour') ) ? $v->errors()->first('d_hour') : '';
            $e['d_minute'] = ( $v->errors()->has('d_minute') ) ? $v->errors()->first('d_minute') : '';

        	return $e;
        }
    // end validation on form submit

    // start save new game details
        public function store($id, Request $request)
        {
            $game = Team::find($id)->all_games_id;
            $opp_detail_id = $request->opponent;
            if( $opp_detail_id == 0 )
            {
                $opp  = Team::where('teamname', $request->name)->first();
                if( $opp == '' )
                    $opp = Team::newTeam($request->name, $game);
            }
            else
            {
                $opp = OpponentDetail::getOpponentTeamID($opp_detail_id);
            }
            //return $opp;

            $gteam = GameTeam::newGame($id, $opp->id, 0);

        	if( $opp_detail_id == 0 )
                $opp = $this->newOpponent($id, $request);

            if( $request->location == 0 )
                $loc = $this->newLocation($id, $request);

        	$i = new GameDetail();
            $i->game_team_id = $gteam->id;
        	$i->date = $request->date;
            $i->hour = $request->hour;
            $i->minute = $request->minute;
        	$i->time = $request->time;
            $i->opponent_detail_id = ( $opp_detail_id == 0 ) ? $opp->id : $opp_detail_id;
        	$i->result = $request->result;
        	$i->location_detail_id = ( $request->location == 0 ) ? $loc->id : $request->location;
            $i->place = $request->place;
            $i->uniform = $request->uniform;
            $i->duration_hour = $request->d_hour;
            $i->duration_minute = $request->d_minute;
        	$i->save();

        	return redirect($id.'/schedule');
        }
    // end save new game details

    // start update game details
        public function editStore($id, Request $request)
        {

            $game = Team::find($id)->all_games_id;
            $opp_detail_id = $request->opponent;
            if( $opp_detail_id == 0 )
            {
                $opp  = Team::where('teamname', $request->name)->first();
                if( $opp == '' )
                    $opp = Team::newTeam($request->name, $game);
            }
            else
            {
                $opp = OpponentDetail::getOpponentTeamID($opp_detail_id);
            }
            //return $opp;

            GameTeam::find($request->id)->update(['team2_id' => $opp->id]);

            if( $opp_detail_id == 0 )
                $opp = $this->newOpponent($id, $request);

            if( $request->location == 0 )
                $loc = $this->newLocation($id, $request);

            $opp_id = ( $opp_detail_id == 0 ) ? $opp->id : $opp_detail_id;
            $loc_id = ( $request->location == 0 ) ? $loc->id : $request->location;

            GameDetail::where('game_team_id', $request->id)->update([
                    'date' => $request->date,
                    'hour' => $request->hour,
                    'minute' => $request->minute,
                    'time' => $request->time,
                    'opponent_detail_id' => $opp_id,
                    'result' => $request->result,
                    'location_detail_id' => $loc_id,
                    'place' => $request->place,
                    'uniform' => $request->uniform,
                    'duration_hour' => $request->d_hour,
                    'duration_minute' => $request->d_minute
                ]);

            return redirect($id.'/schedule');
        }
    // end update game details

    // start fetch details of scheduled game
        public function getData($id, $game_id)
        {
            $game = GameTeam::find($game_id);

            if( $game->game_type == 0 )
            {
              $game->detail = GameDetail::where('game_team_id', $game->id)->first();
              $game->opp    = OpponentDetail::find($game->detail->opponent_detail_id);
              $game->loc    = LocationDetail::find($game->detail->location_detail_id);
            }
            else
            {
              $game->detail = LeagueMatchDetail::where('game_team_id', $game->id)->first();
              $game->loc    = LeagueLocation::find($game->detail->league_location_id);
              $game->detail->time = ($game->detail->time == 0) ? 'AM' : 'PM';
            }

            $min = $game->detail->minute;
            $game->detail->minute = ($min < 10) ? '0'.$min : $min;

            $opp_id = ($game->team1_id == $id) ? $game->team2_id : $game->team1_id;
            $game->name = Team::find($opp_id)->teamname;
            return $game;
        }
    // end fetch details of scheduled game

    // start delete a game
        public function delete($id, $game_id)
        {
            GameTeam::find($game_id)->delete();
            return redirect($id.'/schedule');
        }
    // end delete a game

    // start save new opponent details
        public function newOpponent($id, $request)
        {
            $opp = new OpponentDetail();
            $opp->team_id = $id;
            $opp->contact_person = $request->contact_person;
            $opp->phone_no = $request->phone;
            $opp->email = $request->email;
            $opp->save();

            return $opp;
        }
    // end save new opponent details

    // start save new location details
        public function newLocation($id, $request)
        {
            $loc = new LocationDetail();
            $loc->team_id = $id;
            $loc->type = 0;
            $loc->name = $request->loc_name;
            $loc->detail = $request->location_detail;
            $loc->address = $request->address;
            $loc->link = $request->link;
            $loc->save();

            return $loc;
        }
    // end save new location details
}
