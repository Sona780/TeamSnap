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
use TeamSnap\League;
use TeamSnap\LeagueAccessManage;
use TeamSnap\LeagueManager;

use TeamSnap\Mail\Manager;

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
            //return $managers;
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

    // start  league settings page
        public function leagueSetting($id)
        {
          $uid = Auth::user()->id;
          $league = League::find($id);
          if( $uid != $league->user_id )
            return view('errors/404');

          $composerWrapper = new UserComposer( $id, 'league' );
          $composerWrapper->compose();

          $public = LeagueAccessManage::getPermissions($id, 0);
          $manage = LeagueAccessManage::getPermissions($id, 1);

          $managers = LeagueManager::getManagers($id);
          //return $managers;

          return view('league.settings', compact('id', 'league', 'public', 'manage', 'managers'));
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
                return Redirect::back();
            	//return redirect($id.'/settings');
            }

            session()->flash('pass', 'Entered current password is incorrect.');
            return Redirect::back();
     	}
    // end validate & update password

 	// start update public access permissions
        public function publicAccessUpdate($id, Request $request)
        {
            $type = $request->teamleague;
            session()->flash('success', 'The access permissions for public url been changed successfully.');
            if( $type == 'team' )
            {
                AccessManage::PublicAccess($id)->update($request->except('_token', 'teamleague'));
                return redirect($id.'/settings');
            }
            LeagueAccessManage::where('league_id', $id)->where('type', 0)->update($request->except('_token', 'teamleague'));
            return redirect('league/'.$id.'/settings');
        }
    // end update public access permissions

    // start update manager access permissions
        public function managerAccessUpdate($id, Request $request)
        {
            $type = $request->teamleague;
            session()->flash('success', 'The access permissions for managers been changed successfully.');
            if( $type == 'team' )
            {
                AccessManage::ManagerAccess($id)->update($request->except('_token', 'teamleague'));
                return redirect($id.'/settings');
            }
            LeagueAccessManage::where('league_id', $id)->where('type', 1)->update($request->except('_token', 'teamleague'));
            return redirect('league/'.$id.'/settings');
        }
    // end update manager access permissions

    // start add new manager
        public function newManager($id, Request $request)
        {
            $type = $request->teamleague;

            $email = $request->email;
            $fname = $request->fname;
            $user  = User::where('email', $email)->first();
            $owner = Auth::user();
            $ch = 0;
            $uid = 0;

            if( $user == '' )
            {
                $ch   = 1;
                $user = User::create(['name' => $fname, 'email' => $email]);
            }

            if( $type == 'team' )
            {
                $name  = Team::find($id)->teamname;
                $tuser = TeamUser::where('teams_id', $id)->where('users_id', $user->id)->first();

                if( $tuser == '' )
                {
                    $tuser = TeamUser::create(['teams_id' => $id, 'users_id' => $user->id]);
                    TeamUserDetail::create(['team_users_id' => $tuser->id, 'role' => 'manager', 'flag' => 0]);
                    $uid = $tuser->id;
                }
                else
                    TeamUserDetail::find($tuser->id)->update(['role' => 'manager', 'flag' => 0]);
            }
            else
            {
                $name  = League::find($id)->league_name;
                $tuser = LeagueManager::where('league_id', $id)->where('user_id', $user->id)->first();

                if( $tuser == '' )
                {
                    $tuser = LeagueManager::create(['league_id' => $id, 'user_id' => $user->id]);
                    $uid = $tuser->id;
                }
            }

            if( $ch == 1 )
                UserDetail::create([
                    'users_id' => $user->id, 'firstname' => $fname,
                    'lastname' => $request->lname, 'manager_access' => 2
                ]);
            else
                UserDetail::where('users_id', $user->id)->update(['manager_access' => 2]);

            /*$mail = new Manager($owner->name, $owner->email, $name, $email, $type);
            Mail::to($email)->send($mail);*/
            return $uid;
        }
    // end add new manager

    // start delete team manager
        public function deleteManager($id, $type, $uid)
        {
            if( $type == 'team' )
            {
                $tuser = TeamUser::find($uid);
                $user  = User::find($tuser->users_id);
                $tuser->delete();
            }
            else
            {
                $tuser = LeagueManager::find($uid);
                $user  = User::find($tuser->user_id);
                $tuser->delete();
            }

            session()->flash('success', $user->name.' has been removed from team manager post.');
            return Redirect::back();
        }
    // end delete team manager
}
