<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Ctg;
use TeamSnap\Team;
use DB;
class MemberController extends Controller
{
   public function index($id)
   {
     $team_id = Team::where('teamname',$id)->select('id')->get()->first();
     $ctgs = Ctg::where('team_id', $team_id->id)->get();
     $users = DB::table('users')
            ->leftjoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->where('user_details.team_id','=', $team_id->id)
            ->get();
          
   
     return view('member',compact('id','ctgs','users'));
   }


}
