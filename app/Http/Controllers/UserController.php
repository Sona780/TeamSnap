<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\User;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use Carbon\Carbon;
use Auth;
use Image;

class UserController extends Controller
{
  // start show user profile
    public function show()
    {
      $id = $this->getUserID();

      $user['mail']   = Auth::user()->email;
      $user['detail'] = UserDetail::where('users_id', $id)->first();

    	return view('pages.profile', compact('user'));
    }
  // end show user profile

  // start update user contact info
    public function updateContact(Request $request)
    {
      UserDetail::where('users_id', $this->getUserID())->update(['mobile' => $request->phone]);
    }
  // end update user contact info

  // start update user basic info
    public function updateBasicInfo(Request $request)
    {
      $uid = $this->getUserID();

      $fname = $request->fname;
      $lname = $request->lname;
      $birth = $request->birthday;

      UserDetail::where('users_id', $uid)->update([ 'firstname' => $fname,
                           'lastname'  => $lname,
                           'gender'    => $request->gender,
                           'birthday'  => $birth
                ]);

      User::find($uid)->update(['name' => $fname]);
      if( $birth != '' )
        $birth = Carbon::createFromFormat('d/m/Y', $birth)->format('M d, Y');
      return $birth;
    }
  // end update user basic info

  // start update user avatar
    public function updateAvatar(Request $request)
    {
      if($request->hasFile('avatar'))
      {
        $id       = Auth::user()->id;
        $avatar   = $request->file('avatar');
        if( filesize($avatar) > 50000 )
        {
          session()->flash('error', 'The size of the profile picture should be less than 50, 000 bytes or 50 KB.');
          return redirect('profile');
        }
        $filename = time().'.'.$avatar->getClientOriginalExtension();
        $path     = '/images/avatars/'.$filename;

        Image::make($avatar)->resize(300,300)->save(config('paths.public_html').$path);
        UserDetail::where('users_id', $id)->update(['avatar' => $path]);
      }
      session()->flash('success', 'Profile picture updated successfully.');
      return redirect('profile');
    }
  // end update user avatar

  // start get user id
    public function getUserID()
    {
      return Auth::user()->id;
    }
  // end get user id
}
