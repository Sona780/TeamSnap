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
       $userid= Auth::user()->id;
       $inputs =  new Team;
       $inputs->teamname= $request->get('teamname');  
       $inputs->sport=Input::get('sport');
       $inputs->country=Input::get('country');
       $inputs->zip=$request->get('zipcode');
       if($request->hasFile('team_logo'))
       {
           
           $teamlogo = $request->file('team_logo');
           $filename = time().'.'.$teamlogo->getClientOriginalExtension();
           Image::make($teamlogo)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
           $inputs->team_logo= $filename; 
        }
        
        Auth::user()->teams()->save($inputs);

        $uid= Auth::user()->id;
        $members = new Member(array(
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
            'flag'=> Input::get('optradio1') == 'true' ? 1 : 0,
            'email'=>$request->get('email'),
            'team_name'=>$inputs->teamname,
            'user_id'=>$uid,
        ));
       $members->save();


       return redirect($inputs->teamname.'/dashboard');
    }

     

   public function api()
   {

   }

}
