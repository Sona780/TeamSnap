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

    public function index($id)
    {
      //$team_name = \Request::get('team_name');
    	// $teams = DB::table('teams')->get();
      //  $id=Auth::user()->id;
     //  $teamname=Team::select('teamname')->get()->first();
     //  $q=$teamname->teamname;
      return view('addmember', [ 'teamname' => $id ] );
    }

    public function store($id, Request $request)
    {

        $data=$request->get('playertype');
        if($data == 1)
          {
            $flag1=true;
          }
        else
          {
            $flag1 = false;
          }
        $uid= Auth::user()->id;
        $teamname=$id;
        $members = new Member(array(
              'firstname' => $request->get('firstname'),
              'lastname'  => $request->get('lastname'),
              'flag'      => $flag1,
              'email'     => $request->get('email'),
              'mobile'    => $request->get('mobile'),
              'role'      => $request->get('role'),
              'birthday'  => $request->get('birthday'),
              'city'      => $request->get('city'),
              'state'     => $request->get('state'),
              'team_name' => $teamname,
              'user_id'   => $uid,
        ));
        $members->save();
        return redirect($id.'/members');

    }

    public function show($id)
    {
          $memberdetails = DB::table('members')->get();
          $teammembers = Member::where('team_name', $id)->get();

          return view('member', [ 'teamname' => $id, 'teammembers' => $teammembers ]);
    }

}
