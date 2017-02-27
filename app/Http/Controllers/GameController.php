<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Game;
use Validator;
use Auth;
//use TeamSnap\Http\Requests\CreateGame;

class GameController extends Controller
{
    //
    public function vali(Request $request)
    {
    	$v = Validator::make($request->all(), [
            'date' => 'required|date',
            'hour' => 'required|between:1,12|numeric',
            'minute' => 'required | numeric | between: 0, 59',
            'opponent' => 'required | string',
            'location' => 'required | string',
            'location_detail' => 'required | string'
        ]);


    	$e['date'] = ( $v->errors()->has('date') ) ? $v->errors()->first('date') : '';
    	$e['hour'] = ( $v->errors()->has('hour') ) ? $v->errors()->first('hour') : '';
    	$e['minute'] = ( $v->errors()->has('minute') ) ? $v->errors()->first('minute') : '';
    	$e['opponent'] = ( $v->errors()->has('opponent') ) ? $v->errors()->first('opponent') : '';
    	$e['location'] = ( $v->errors()->has('location') ) ? $v->errors()->first('location') : '';
    	$e['location_detail'] = ( $v->errors()->has('location_detail') ) ? $v->errors()->first('location_detail') : '';

    	return $e;
    }

    public function store(Request $request)
    {

    	//return $request->time;
    	$i = new Game();
    	$i->user_id = Auth::user()->id;
    	$i->date = $request->date;
    	$i->time = $request->hour.":".( ($request->minute < 10) ? '0'.$request->minute : $request->minute )." ".$request->time;
    	$i->opponent = $request->opponent;
    	$i->location = $request->location;
    	$i->location_detail = $request->location_detail;
    	$i->save();

    	return redirect('schedule');
    }
}
