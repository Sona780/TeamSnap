<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\User;
use TeamSnap\Userdetail;
use TeamSnap\TeamUser;
use Carbon\Carbon;
use Auth;
use Image;

class UserController extends Controller
{
    public function show()
    {
      $id = $this->getUserID();

      $user['mail']   = Auth::user()->email;
      $user['detail'] = Userdetail::where('users_id', $id)->first();

    	return view('pages.profile', compact('user'));
    }

    public function store($id, Request $request)
    {
      if($request->hasFile('avatar'))
       {

       	   $avatars = $request->file('avatar');
       	   $filename = time().'.'.$avatars->getClientOriginalExtension();
       	   Image::make($avatars)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
           $avatar = User::where('id',$id)->select('avatar')->get()->first();
           $avatar->avatar=$filename;
           $avatar->save();
           User::where('id',$id)->update(['avatar' => $avatar->avatar]);
          
       }
       return redirect($id.'/userprofile');
    }

    public function updateContact(Request $request)
    {
      Userdetail::where('users_id', $this->getUserID())->update(['mobile' => $request->phone]);
    }

    public function updateBasicInfo(Request $request)
    {
      $uid = $this->getUserID();

      $fname = $request->fname;
      $lname = $request->lname;
      $birth = $request->birthday;

      Userdetail::where('users_id', $uid)
                ->update([ 'firstname' => $fname,
                           'lastname'  => $lname,
                           'gender'    => $request->gender,
                           'birthday'  => $birth
                ]);

      User::find($uid)->update(['name' => $fname]);

      $birth = Carbon::createFromFormat('d/m/Y', $birth)->format('M d, Y');

      return $birth;
    }

    public function getUserID()
    {
      return Auth::user()->id;
    }

    public function valiMail($uid, $email)
    {
      if( $uid == 0 )
        $cnt = User::where('email', $email)->get()->count();
      else
      {
        $umail = User::find(TeamUser::find($uid)->users_id)->email;
        $cnt   = 0;
        if( $umail != $email )
          $cnt = User::where('email', $email)->get()->count();
      }
      return $cnt;
    }
}
