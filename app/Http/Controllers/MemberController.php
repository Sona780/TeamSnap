<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Ctg;
use TeamSnap\Team;
use DB;
use TeamSnap\PlayerCtg;

class MemberController extends Controller
{
   public function index($id)
   {
     $team_id = Team::where('teamname',$id)->select('id')->get()->first();
    
     $ctgs =  DB::table('ctgs')
             ->get();
            
     $users = DB::table('users')
                ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                ->leftJoin('team_users', 'users.id', '=', 'team_users.user_id' )
                ->leftJoin('player_ctgs', 'users.id', '=', 'player_ctgs.user_id')
               ->get();
             
     return view('member',compact('id','ctgs','users'));
   }


}
