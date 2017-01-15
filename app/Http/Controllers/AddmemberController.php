<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\Http\Requests;
use Auth;

use DB;
use TeamSnap\Member;
use TeamSnap\Team;
use Illuminate\Support\Facades\Input;

class AddmemberController extends Controller
{

    public function index()
    {
    	$teams = DB::table('teams')->get();

      $id=Auth::user()->id;
      $teamname=Team::select('teamname')->get()->first();
      $q=$teamname->teamname;
      // dd($q);
      
      return view('addmember',compact('teams','q'));
    }

    public function store($id,Request $request)
    {
          
        $data=Input::get('ch');
        $uid= Auth::user()->id;
        $teamname=$id;
        
        if($data==["1"])

            {

               $study = new Member(array(
              'firstname' => $request->get('firstname'),
              'lastname'  => $request->get('lastname'),
              'flag'=>false,
              'email'=>$request->get('email'),
              'team_name'=>$teamname,
              'user_id'=>$uid,
               ));

           }
     else

            {

            $study = new Member(array(
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
            'flag'=>true,
            'email'=>$request->get('email'),
            'team_name'=>$teamname,
            'user_id'=>$uid,
            ));

           }
          
          $study->save();
          return redirect('/team_setup');
          

    }

    public function show($id)
    {
          $memberdetails=DB::table('members')->get();
          $teammembers = Member::where('team_name', $id)->get();
          return view('member',compact('teammembers'));

    }
    public function api()
    {

    }

}
