<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\AccessManage;
use TeamSnap\User;
use TeamSnap\UserDetail;
use TeamSnap\TeamUserDetail;
use TeamSnap\TeamManager;

use TeamSnap\Mail\SendMail;

use Auth;
use Hash;
use Mail;
use Redirect;

use TeamSnap\Http\ViewComposer\UserComposer;

class SettingController extends Controller
{
    // start show settings page
        public function show($id)
        {
          $uid    = Auth::user()->id;
          $user   = UserDetail::where('users_id', $uid)->first();
          $owner  = Team::find($id)->team_owner_id;

          $manager = '';
          if( $user->manager_access == 2 )
            $manager = TeamUser::CheckMembership($id, $uid)->first();

          if( $uid == $owner || $manager != '' )
          {
            $team = Team::find($id);
            $managers = TeamUser::getManagers($id);
            foreach ($managers as $manager)
              $manager->data = User::userData($manager->user_id);

            $public  = AccessManage::findPublicAccessDetail($id);
            $manage  = AccessManage::findManagerAccessDetail($id);

            $composerWrapper = new UserComposer( $id, 'team' );
            $composerWrapper->compose();

            return view('pages.settings', compact('id', 'team', 'managers', 'public', 'manage'));
          }
          return view('errors/404');
        }
    // end show settings page

    // start validate & update password
        public function newPassword($id, Request $request)
        {
        	$this->validate($request, [
                'current'  => 'required',
                'password' => 'required|min:6|confirmed',
            ], [
            	'*.required' => 'The field is required.'
            ]);

        	$user = Auth::user();
        	$curr = $request->current;
            if (Hash::check($curr, $user->password))
            {
            	$user->update(['password' => bcrypt($request->password)]);
            	session()->flash('success', 'The password has been successfully updated.');
            	return redirect($id.'/settings');
            }

            session()->flash('pass', 'Entered current password is incorrect.');
            return Redirect::back();
     	}
    // end validate & update password

 	// start update public access permissions
        public function publicAccessUpdate($id, Request $request)
        {
            AccessManage::PublicAccess($id)->update($request->except('_token'));
            session()->flash('success', 'The access permissions for public url been changed successfully.');
            return redirect($id.'/settings');
        }
    // end update public access permissions

    // start update manager access permissions
        public function managerAccessUpdate($id, Request $request)
        {
            AccessManage::ManagerAccess($id)->update($request->except('_token'));
            session()->flash('success', 'The access permissions for managers been changed successfully.');
            return redirect($id.'/settings');
        }
    // end update manager access permissions

    // start add new manager
        public function newManager($id, Request $request)
        {
            $email = $request->email;
            $fname = $request->fname;
            $ch = User::where('email', $email)->count();
            if( $ch > 0 )
                return $ch;
            $owner = Auth::user();
            $team = Team::find($id);
            $user = User::create(['name' => $fname, 'email' => $email]);
            UserDetail::create(['users_id' => $user->id, 'firstname' => $fname, 'lastname' => $request->lname, 'manager_access' => 2]);
            $tuser = TeamUser::create(['teams_id' => $id, 'users_id' => $user->id]);
            TeamUserDetail::create(['team_users_id' => $tuser->id, 'role' => 'manager', 'flag' => 0]);

            /*$mail = new SendMail($owner->name, $owner->email, $team->teamname, $email);
            Mail::to($email)->send($mail);*/
            return $user;
        }
    // end add new manager

    // start delete team manager
        public function deleteManager($id, $uid)
        {
            $user = User::find($uid);
            session()->flash('success', $user->name.' has been removed from team manager post.');
            $user->delete();
            return redirect($id.'/settings');
        }
    // end delete team manager
}
