<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Event;
use Validator;
use Auth;

class EventController extends Controller
{
    //
    public function vali(Request $request)
    {
    	$v = Validator::make($request->all(), [
    		'name' => 'required|string',
            'date' => 'required|date',
            'hour' => 'required|between:1,12|numeric',
            'minute' => 'required | numeric | between: 0, 59',
            'location' => 'required | string',
            'location_detail' => 'required | string'
        ]);

    	$e['name'] = ( $v->errors()->has('name') ) ? $v->errors()->first('name') : '';
    	$e['date'] = ( $v->errors()->has('date') ) ? $v->errors()->first('date') : '';
    	$e['hour'] = ( $v->errors()->has('hour') ) ? $v->errors()->first('hour') : '';
    	$e['minute'] = ( $v->errors()->has('minute') ) ? $v->errors()->first('minute') : '';
    	$e['location'] = ( $v->errors()->has('location') ) ? $v->errors()->first('location') : '';
    	$e['location_detail'] = ( $v->errors()->has('location_detail') ) ? $v->errors()->first('location_detail') : '';

    	return $e;
    }

    public function store(Request $request)
    {

    	//return $request->time;
    	$i = new Event();
    	$i->user_id = Auth::user()->id;
    	$i->name = $request->name;
    	$i->date = $request->date;
    	$i->time = $request->hour.":".( ($request->minute < 10) ? '0'.$request->minute : $request->minute )." ".$request->time;
    	$i->repeat = $request->repeat;
    	$i->location = $request->location;
    	$i->location_detail = $request->location_detail;
    	$i->save();

    	return redirect('schedule');
    }
}
