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
    //show existing members
    public function index($id)
    {
        $team = Team::find($id);

        if($team == NULL)
          return view('errors/404');
        else
        {
            $owner = User::find($team->team_owner_id);

            $members = TeamUser::members($id)->get();
            $distinct_members = TeamUser::members($id)->groupBy('player_ctgs.user_id')->get();

            $ctgs = TeamCtg::where('team_id', $id)->get();

            return view('pages.members',compact('id','ctgs','members', 'distinct_members'));
            //return $distinct_members;
        }
   }
   //end show existing members

   //save new member
   public function store($id, Request $request)
    {
        //get selected categoeries of new member
        $c = $this->selectedCat($request->categories);

        //create new user
        $user = new User();
        $user->name = $request->firstname;
        $user->email = $request->email;
        $user->save();
        //end create new user

        //save new user details
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
        //end save new user details

        //link member with team
        $team_users = new TeamUser(array(
              'team_id' => $id,
              'user_id' => $user->id,
        ));
        $team_users->save();
        //end link member with team

        //specify member categories
        $this->saveCat($id, $user->id, $c);
        //end specify member categories

        return redirect($id.'/members');
    }
    //end save new member

    //fetch data of existing member
    public function get($id)
    {
      $user_id = PlayerCtg::find($id)->user_id;
      $data = User::find($user_id);
      $data['details'] = UserDetail::where('user_id', $user_id)->first();
      $data['ctg'] = PlayerCtg::where('user_id', $user_id)->get();

      return $data;
    }
    //end fetch data of existing member

    //delete a member
    public function delete($id, $p_ctg)
    {
      User::find(PlayerCtg::find($p_ctg)->user_id)->delete();
      return redirect($id.'/members');
    }
    //end delete a member

    //update existing member info
    public function update($id, Request $request)
    {
      //get selected categoeries of new member
      $c = $this->selectedCat($request->categories);

      //get member id
      $user_id = PlayerCtg::find($request->id)->user_id;

      //update user
      User::find($user_id)->update([
            'name' => $request->firstname,
            'email' => $request->email
        ]);
      //end update user

      //update user details
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
      //end update user details

      //update member categories
      PlayerCtg::where('user_id', $user_id)->delete();
      $this->saveCat($id, $user_id, $c);
      //end update member categories

      return redirect($id.'/members');
    }
    //end update existing member info

    //get selected categoeries of new member
   public function selectedCat($cats)
   {
    $c = [];
    $i = 0;
    foreach($cats as $cat)
      $c[$i++] = $cat;
    return $c;
   }
   //end get selected categoeries of new member

   //save memeber categories
   public function saveCat($t_id, $u_id, $c)
   {
    foreach ($c as $cat)
    {
      $ctg = new PlayerCtg();
      $ctg->team_id = $t_id;
      $ctg->user_id = $u_id;
      $ctg->team_ctgs_id = $cat;
      $ctg->save();
    }
   }
   //end save memeber categories
}
