<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Http\Requests;
use Auth;
use DB;
use TeamSnap\UserDetail;
use TeamSnap\Team;
use Illuminate\Support\Facades\Input;
use TeamSnap\PlayerCtg;
use TeamSnap\User;
use TeamSnap\Ctg;
use TeamSnap\TeamUser;

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
        
        $teamid = Team::where('teamname',$id)->select('id')->get()->first();
        $users= new User(array(
             'name' => $request->get('firstname').' '.$request->get('lastname'),
             'email'=> $request->get('email'),
        )); 
       $users->save();

        $uid= $users->id;
        $members = new UserDetail(array(
              'firstname'       => $request->get('firstname'),
              'lastname'        => $request->get('lastname'),
              'flag'            => $request->get('optradio'),
              'mobile'          => $request->get('mobile'),
              'role'            => $request->get('role'),
              'birthday'        => $request->get('birthday'),
              'city'            => $request->get('city'),
              'state'           => $request->get('state'),
              'user_id'         => $uid,
              'team_id'         => $teamid->id,
              
        ));
        dd($members->manager_access);
        $members->save();

        $team_users = new TeamUser(array(
              'team_id' => $teamid->id,
              'user_id' => $uid,
        ));
        $team_users->save();
        
        $ctgs =  DB::table('ctgs')->get();  
      
        foreach($ctgs as $ctg)
        {  
          $player_ctgs = new PlayerCtg(array(
             'team_id' => $teamid->id,
             'ctg_id'  => (Input::has('ctg'.$ctg->id)) ? 1 : 0,
             'user_id' => $uid,
          ));
          if($player_ctgs->ctg_id != '' || $player_ctgs->ctg_id != NULL ) 
           {
            $player_ctgs->ctg_id = $ctg->id;
            $player_ctgs->save();  
           }

        }
        

        return redirect($id.'/members');
    }

    public function show($id)
    {
          $memberdetails = DB::table('members')->get();
          $teammembers = Member::where('team_name', $id)->get();
          $memberid = Member::where('team_name', $id)->select('id')->get()->first();
          return view('member');
    }

}
