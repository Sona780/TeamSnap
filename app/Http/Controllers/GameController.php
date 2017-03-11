<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Game;
use TeamSnap\Opponent;
use TeamSnap\Location;
use Validator;
use Auth;
//use TeamSnap\Http\Requests\CreateGame;

class GameController extends Controller
{
    //validation on form submit
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

    //save new game details
    public function store($id, Request $request)
    {
    	if( $request->opponent == 0 )
            $opp = $this->newOpponent($id, $request);

        if( $request->location == 0 )
            $loc = $this->newLocation($id, $request);

    	$i = new Game();
        $i->users_id = Auth::user()->id;
    	$i->teams_id = $id;
    	$i->date = $request->date;
        $i->hour = $request->hour;
        $i->minute = $request->minute;
    	$i->time = $request->time;
        $i->opponents_id = ( $request->opponent == 0 ) ? $opp->id : $request->opponent;
    	$i->results = $request->result;
    	$i->locations_id = ( $request->location == 0 ) ? $loc->id : $request->location;
        $i->place = $request->place;
        $i->uniform = $request->uniform;
        $i->duration_hour = $request->d_hour;
        $i->duration_minute = $request->d_minute;
    	$i->save();

    	return redirect($id.'/schedule');
    }

    //update game details
    public function editStore($id, Request $request)
    {
        $game = Game::find($request->id);
        if( $request->opponent == 0 )
            $opp = $this->newOpponent($id, $request);

        if( $request->location == 0 )
            $loc = $this->newLocation($id, $request);

        $opp_id = ( $request->opponent == 0 ) ? $opp->id : $request->opponent;
        $loc_id = ( $request->location == 0 ) ? $loc->id : $request->location;

        $game->update([
                'date' => $request->date,
                'hour' => $request->hour,
                'minute' => $request->minute,
                'time' => $request->time,
                'opponents_id' => $opp_id,
                'results' => $request->result,
                'locations_id' => $loc_id,
                'place' => $request->place,
                'uniform' => $request->uniform,
                'duration_hour' => $request->d_hour,
                'duration_minute' => $request->d_minute
            ]);

        return redirect($id.'/schedule');
    }

    //fetch details of scheduled game
    public function getData($game_id)
    {
        $data = Game::find($game_id);
        $opp = Opponent::find($data->opponents_id);
        $loc = Location::find($data->locations_id);

        $data->opp_id = $opp->id;
        $data->name = $opp->name;
        $data->contact_person = $opp->contact_person;
        $data->phone_no = $opp->phone_no;
        $data->email = $opp->email;

        $data->loc_id = $loc->id;
        $data->loc_name = $loc->name;
        $data->loc_detail = $loc->detail;
        $data->address = $loc->address;
        $data->link = $loc->link;

        return $data;
    }

    //delete a game
    public function delete($id, $game_id)
    {
        Game::find($game_id)->delete();
        return redirect($id.'/schedule');
    }

    //save new opponent details
    public function newOpponent($id, $request)
    {
        $opp = new Opponent();
        $opp->teams_id = $id;
        $opp->name = $request->name;
        $opp->contact_person = $request->contact_person;
        $opp->phone_no = $request->phone;
        $opp->email = $request->email;
        $opp->save();

        return $opp;
    }

    //save new location details
    public function newLocation($id, $request)
    {
        $loc = new Location();
        $loc->teams_id = $id;
        $loc->type = 0;
        $loc->name = $request->loc_name;
        $loc->detail = $request->location_detail;
        $loc->address = $request->address;
        $loc->link = $request->link;
        $loc->save();

        return $loc;
    }
}
