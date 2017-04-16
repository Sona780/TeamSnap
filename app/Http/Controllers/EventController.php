<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Event;
use TeamSnap\LocationDetail;
use Validator;
use Auth;

class EventController extends Controller
{
    //validate event details on submit
    public function vali(Request $request)
    {
    	$v = Validator::make($request->all(), [
    		'name' => 'required|string',
            'date' => 'required',
            'hour' => 'required|between:1,12|numeric',
            'minute' => 'required | numeric | between: 0, 59',

            'location' => 'required',
            'loc_name' => ($request->location == 0) ? 'required|string' : 'string',
            'location_detail' => 'string',
            'address' => 'string',
            'link' => 'URL',
        ]);

    	$e['name'] = ( $v->errors()->has('name') ) ? $v->errors()->first('name') : '';
    	$e['date'] = ( $v->errors()->has('date') ) ? $v->errors()->first('date') : '';
    	$e['hour'] = ( $v->errors()->has('hour') ) ? $v->errors()->first('hour') : '';
    	$e['minute'] = ( $v->errors()->has('minute') ) ? $v->errors()->first('minute') : '';

        $e['location'] = ( $v->errors()->has('location') ) ? $v->errors()->first('location') : '';
        $e['loc_name'] = ( $v->errors()->has('loc_name') ) ? $v->errors()->first('loc_name') : '';
        $e['location_detail'] = ( $v->errors()->has('location_detail') ) ? $v->errors()->first('location_detail') : '';
        $e['address'] = ( $v->errors()->has('address') ) ? $v->errors()->first('address') : '';
        $e['link'] = ( $v->errors()->has('link') ) ? $v->errors()->first('link') : '';

    	return $e;
    }

    //save new event
    public function store($id, Request $request)
    {
    	if( $request->location == 0 )
            $loc = $this->newLocation($id, $request);

        $request['team_id'] = $id;
        $request['location_detail_id'] = ($request->location == 0) ? $loc->id : $request->location;
        Event::create($request->all());

    	return redirect($id.'/schedule');
    }

    //update event details
    public function editStore($id, Request $request)
    {
        $event = Event::find($request->id);

        if( $request->location == 0 )
            $loc = $this->newLocation($id, $request);
        $request['location_detail_id'] = ($request->location == 0) ? $loc->id : $request->location;

        Event::find($request->id)->update($request->only(['name', 'label', 'date', 'hour', 'minute', 'time', 'repeat', 'location_detail_id']));

        return redirect($id.'/schedule');
    }

    //fetch event details
    public function getData($event_id)
    {
        $event       = Event::find($event_id);
        $event->loc  = LocationDetail::find($event->location_detail_id);
        return $event;
    }

    //delete an event
    public function delete($id, $event_id)
    {
        Event::find($event_id)->delete();
        return redirect($id.'/schedule');
    }

    //save new event location
    public function newLocation($id, $request)
    {
        $loc = new LocationDetail();
        $loc->team_id = $id;
        $loc->type    = 1;
        $loc->name    = $request->loc_name;
        $loc->detail  = $request->location_detail;
        $loc->address = $request->address;
        $loc->link    = $request->link;
        $loc->save();

        return $loc;
    }
}
