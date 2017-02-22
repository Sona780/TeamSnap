<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Ctg;
use TeamSnap\Team;
use DB;
use TeamSnap\PlayerCtg;
use Auth;

class MemberController extends Controller
{
   public function index($id)
   {
      $user_id = Auth::user()->id;
       $team_name = Team::where('team_owner_id',$user_id)->value('teamname');
       if($team_name == '' || $team_name== NULL)
       {
        return view('errors/404');
       }
       else{
             $team_id = Team::where('teamname',$id)->value('id');
            
             $ctgs =  DB::table('ctgs')
                     ->get();
                    
             $users = DB::table('users')
                        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                        ->leftJoin('team_users', 'users.id', '=', 'team_users.user_id' )
                        ->leftJoin('player_ctgs', 'users.id', '=', 'player_ctgs.user_id')
                        ->where('team_users.team_id', $team_id)
                        ->get();
                    
             return view('member',compact('id','ctgs','users'));
      }
   }


}
