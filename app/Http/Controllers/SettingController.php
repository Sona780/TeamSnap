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
use TeamSnap\LeagueDivision;
use TeamSnap\DivisionManager;

use TeamSnap\Mail\Manager;

use Auth;
use Hash;
use Mail;
use Redirect;

use TeamSnap\Http\ViewComposer\UserComposer;
use TeamSnap\Http\Controllers\DashboardController;

class SettingController extends Controller
{
    // start show settings page
        public function show($id)
        {
          $uid    = Auth::user()->id;
          $user   = UserDetail::where('users_id', $uid)->first();
          $owner  = Team::find($id)->team_owner_id;
          $access = AccessManage::getDetail($id);

          $manager = '';
          if( $user->manager_access == 2 )
            $manager = TeamUser::CheckMembership($id, $uid)->first();

          if( $owner == $uid || ($manager != '' && $access->setting == 1) )
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
        public function leagueSetting($id, $ldid)
        {

          $user = Auth::user();
          $uid  = $user->id;
          $ch   = League::find($id)->user_id;
          $man  = DivisionManager::check($uid, $ldid);

          if( $uid != $ch && $man == 0 )
            return view('errors/404');

          $composerWrapper = new UserComposer( $id, 'league' );
          $composerWrapper->compose();

          $public = LeagueAccessManage::getPermissions($id, 0);
          $manage = LeagueAccessManage::getPermissions($id, 1);

          $managers = DivisionManager::getManagers($ldid);
          $d = new DashboardController();
          $prev = $d->path($ldid);
          $curr = LeagueDivision::find($ldid)->division_name;

          return view('league.settings', compact('id', 'league', 'public', 'manage', 'managers', 'curr', 'prev', 'ldid'));
        }
    // end show settings page

    // start validate & update password
        public function newPassword(Request $request)
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
                return redirect('home');
            }

            session()->flash('pass', 'Incorrect current incorrect.');
            return Redirect::back();
     	}
    // end validate & update password

 	// start update public access permissions
        public function publicAccessUpdate($id, Request $request)
        {
            $type = $request->teamleague;
            session()->flash('success', 'The access permissions for public url has been changed successfully.');
            session()->flash('active', 11);
            if( $type == 'team' )
            {
                AccessManage::PublicAccess($id)->update($request->except('_token', 'teamleague'));
                return redirect($id.'/settings');
            }
            LeagueAccessManage::where('league_id', $id)->where('type', 0)->update($request->except('_token', 'teamleague'));
            return Redirect::back();
        }
    // end update public access permissions

    // start update manager access permissions
        public function managerAccessUpdate($id, Request $request)
        {
            $type = $request->teamleague;
            session()->flash('success', 'The access permissions for managers has been changed successfully.');
            session()->flash('active', 12);
            if( $type == 'team' )
            {
                AccessManage::ManagerAccess($id)->update($request->except('_token', 'teamleague'));
                return redirect($id.'/settings');
            }
            LeagueAccessManage::where('league_id', $id)->where('type', 1)->update($request->except('_token', 'teamleague'));
            return Redirect::back();
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
            $uid = 0;

            if( $user == '' )
            {
                $user = User::addUserFromLeague($fname, $email, 0);
                UserDetail::addUserFromLeague($user->id, $fname, $request->lname, 2);
            }
            else
            {
                $access = UserDetail::where('users_id', $user->id)->first()->manager_access;
                if($access != 2)
                    return 0;
            }

            if( $type == 'team' )
            {
                $name  = Team::find($id)->teamname;
                $tuser = TeamUser::checkIfManager($id, $user->id);

                if( $tuser == '' )
                {
                    $tuser = TeamUser::createTeamUser($id, $user->id);
                    TeamUserDetail::createNew($tuser->id, 0, 'manager');
                }
                else
                    TeamUserDetail::updateDetail($tuser->id, 0, 'manager');
            }
            else
            {
                $name  = League::find($id)->league_name;
                $tuser = DivisionManager::checkIfManager($id, $user->id);

                if( $tuser == '' )
                    $tuser = DivisionManager::newManager($id, $user->id);
            }

            $uid = $tuser->id;
            $mail = new Manager($owner->name, $owner->email, $name, $email, $type);
            Mail::to($email)->send($mail);
            return $uid;
        }
    // end add new manager

    // start delete team manager
        public function deleteManager($type, $uid)
        {
            //return 'kk';
            if( $type == 'team' )
            {
                $tuser = TeamUser::find($uid);
                $user  = User::find($tuser->users_id)->name;
                $tuser->delete();
            }
            else
            {
                $m = DivisionManager::find($uid);
                $user = User::find($m->user_id)->name;
                $m->delete();
            }

            session()->flash('success', $user.' has been removed from team manager post.');
            session()->flash('active', 2);
            return Redirect::back();
        }
    // end delete team manager
}
