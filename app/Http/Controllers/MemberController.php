<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\User;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\TeamCtg;
use TeamSnap\Team;
use DB;
use TeamSnap\PlayerCtg;
use Auth;

class MemberController extends Controller
{
   public function index($id)
   {
        $team = Team::find($id);

        if($team == NULL)
          return view('errors/404');
        else
        {
            $owner = User::find($team->team_owner_id);

            $members = TeamUser::leftJoin('users', 'users.id', '=', 'team_users.user_id')
                       ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
                       ->leftJoin('player_ctgs', 'users.id', '=', 'player_ctgs.user_id')
                       ->where('team_users.team_id', $id)->get();

            $ctgs = TeamCtg::where('team_id', $id)->get();
            return view('pages.members',compact('id','ctgs','members'));
            return $members;
        }



      $user_id = Auth::user()->id;
       $team_name = Team::where('team_owner_id',$user_id)->value('teamname');
       if($team_name == '' || $team_name== NULL)
       {

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

   public function store($id, Request $request)
    {
        $user = new User();
        $user->name = $request->firstname;
        $user->email = $request->email;
        $user->save();

        $members = new Userdetail(array(
              'firstname' => $request->get('firstname'),
              'lastname'  => $request->get('lastname'),
              'flag'      => $request->get('optradio'),
              'mobile'    => $request->get('mobile'),
              'role'      => $request->get('role'),
              'birthday'  => $request->get('birthday'),
              'city'      => $request->get('city'),
              'state'     => $request->get('state'),
              'user_id'   => $user->id,
              'team_id'   => $id,
        ));
        $members->save();

        $team_users = new TeamUser(array(
              'team_id' => $id,
              'user_id' => $user->id,
        ));
        $team_users->save();

        $ctg = new PlayerCtg();
        $ctg->team_id = $id;
        $ctg->user_id = $user->id;
        $ctg->team_ctgs_id = $request->categories;
        $ctg->save();

        /*$ctgs =  DB::table('ctgs')->get();

        foreach($ctgs as $ctg)
        {
            $player_ctgs = new PlayerCtg(array(
                'team_id' => $id,
                'ctg_id'  => (Input::has('ctg'.$ctg->id)) ? 1 : 0,
                'user_id' => $users->id,
            ));
            if($player_ctgs->ctg_id != '' || $player_ctgs->ctg_id != NULL )
            {
              $player_ctgs->ctg_id = $ctg->id;
              $player_ctgs->save();
            }
        }*/
        return redirect($id.'/members');
    }

    public function get($id)
    {
      $user_id = PlayerCtg::find($id)->user_id;
      //return $user_id;
      $data = User::find($user_id);
      $data['details'] = UserDetail::where('user_id', $user_id)->first();
      $data['cts'] = PlayerCtg::where('user_id', $user_id)->first();

      return $data;
    }

    public function delete($id, $p_ctg)
    {
      User::find(PlayerCtg::find($p_ctg)->user_id)->delete();
      return redirect($id.'/members');
    }

    public function update($id, Request $request)
    {
      $user_id = PlayerCtg::find($request->id)->user_id;
      User::find($user_id)->update([
            'name' => $request->firstname,
            'email' => $request->email
        ]);

      Userdetail::where('user_id', $user_id)->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'flag'      => $request->optradio,
            'mobile'    => $request->mobile,
            'role'      => $request->role,
            'birthday'  => $request->birthday,
            'city'      => $request->city,
            'state'     => $request->state,
        ]);

       PlayerCtg::where('user_id', $user_id)->update(['team_ctgs_id' => $request->categories]);

      return redirect($id.'/members');
    }
}
