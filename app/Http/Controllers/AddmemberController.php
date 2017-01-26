<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Http\Requests;
use Auth;
use DB;
use TeamSnap\Member;
use TeamSnap\Team;
use Illuminate\Support\Facades\Input;
use TeamSnap\PlayerCtg;

class AddmemberController extends Controller
{

    public function index($id)
    {
    	// $teams = DB::table('teams')->get();
      //  $id=Auth::user()->id;
     //  $teamname=Team::select('teamname')->get()->first();
     //  $q=$teamname->teamname;
      return view('addmember', [ 'teamname' => $id ] );
    }

    public function store($id, Request $request)
    {

        $uid= Auth::user()->id;
        $members = new Member(array(
              'firstname' => $request->get('firstname'),
              'lastname'  => $request->get('lastname'),
              'flag'      => $request->get('optradio'),
              'email'     => $request->get('email'),
              'mobile'    => $request->get('mobile'),
              'role'      => $request->get('role'),
              'birthday'  => $request->get('birthday'),
              'city'      => $request->get('city'),
              'state'     => $request->get('state'),
              'team_name' => $id,
              'user_id'   => $uid,
        ));
        $members->save();
        return $members;
    }

    public function show($id)
    {
          $memberdetails = DB::table('members')->get();
          $teammembers = Member::where('team_name', $id)->get();
          $memberid = Member::where('team_name', $id)->select('id')->get()->first();
          $ctgs = PlayerCtg::where('member_id', $memberid->id)->get()->first();

          return view('member', [ 'teamname' => $id, 'teammembers' => $teammembers ,'memberid' => $memberid->id,'p_id'=> $ctgs->playing,'i_id'=>$ctgs->injured,'t_id'=>$ctgs->topstar]);
    }

}
