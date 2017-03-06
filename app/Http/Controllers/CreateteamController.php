<?php
namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TeamSnap\Http\Requests;
use Auth;
use \TeamSnap\Team;
use DB;
use TeamSnap\Member;
use Image;


class CreateteamController extends Controller
{
    public function index()
    {
      
    	return view('createteam');
    }

      public function store(Request $request)
    {
       $userid          =  Auth::user()->id;
       $inputs          =  new Team;
       $inputs->teamname=  $request->get('teamname');
       $inputs->sport   =  Input::get('sport');
       $inputs->country =  Input::get('country');
       $inputs->zip     =  $request->get('zipcode');
       $inputs->team_color_first = $request->get('team_color_first');
       $inputs->team_color_second = $request->get('team_color_second');
       $inputs->team_owner_id = Auth::user()->id;
       if($request->hasFile('team_logo'))
       {

           $teamlogo = $request->file('team_logo');
           $filename = time().'.'.$teamlogo->getClientOriginalExtension();
           Image::make($teamlogo)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
           $inputs->team_logo= $filename;
        }
        $inputs->save();
        return redirect($inputs->id.'/dashboard');

    }

}
