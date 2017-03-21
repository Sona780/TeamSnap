<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Event;
use TeamSnap\Location;
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

    	$i = new Event();
        $i->users_id = Auth::user()->id;
    	$i->teams_id = $id;
        $i->name = $request->name;
    	$i->label = $request->label;
    	$i->date = $request->date;
        $i->hour = $request->hour;
        $i->minute = $request->minute;
        $i->time = $request->time;
    	$i->repeat = $request->repeat;
    	$i->locations_id = ($request->location == 0) ? $loc->id : $request->location;
    	$i->save();

    	return redirect($id.'/schedule');
    }

    //update event details
    public function editStore($id, Request $request)
    {
        $event = Event::find($request->id);

        if( $request->location == 0 )
            $loc = $this->newLocation($id, $request);
        $loc_id = ( $request->location == 0 ) ? $loc->id : $request->location;

        $event->update([
                'name' => $request->name,
                'label' => $request->label,
                'date' => $request->date,
                'hour' => $request->hour,
                'minute' => $request->minute,
                'time' => $request->time,
                'repeat' => $request->repeat,
                'locations_id' => $loc_id,
            ]);

        return redirect($id.'/schedule');
    }

    //fetch event details
    public function getData($event_id)
    {
        $data = Event::find($event_id);
        $loc = Location::find($data->locations_id);

        $data->loc_id = $loc->id;
        $data->loc_name = $loc->name;
        $data->loc_detail = $loc->detail;
        $data->address = $loc->address;
        $data->link = $loc->link;

        return $data;
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
        $loc = new Location();
        $loc->teams_id = $id;
        $loc->type = 1;
        $loc->name = $request->loc_name;
        $loc->detail = $request->location_detail;
        $loc->address = $request->address;
        $loc->link = $request->link;
        $loc->save();

        return $loc;
    }
}
