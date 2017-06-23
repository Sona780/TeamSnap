<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Org4Leagues\Team;
use Org4Leagues\TeamUser;
use Org4Leagues\AccessManage;
use Org4Leagues\User;
use Org4Leagues\UserDetail;
use Org4Leagues\TeamUserDetail;
use Org4Leagues\TeamManager;
use Org4Leagues\League;
use Org4Leagues\LeagueAccessManage;
use Org4Leagues\LeagueManager;
use Org4Leagues\LeagueDivision;
use Org4Leagues\DivisionManager;
use Org4Leagues\AllGame;
use Org4Leagues\Country;
use Org4Leagues\TimeZone;
use Org4Leagues\CustomField;
use Org4Leagues\SitePref;
use Org4Leagues\PublicUrl;

use Org4Leagues\Mail\Manager;

use Auth;
use Hash;
use Mail;
use Redirect;

use Org4Leagues\Http\ViewComposer\UserComposer;
use Org4Leagues\Http\Controllers\DashboardController;

class SettingController extends Controller
{
    // start show settings page
        public function show($id)
        {
          $uid    = session('id') ? session('id') : Auth::user()->id;
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

            $team->game_type  = AllGame::find($team->all_games_id)->game_name;
            $team->cntry_name = Country::find($team->country)->country_name;

            $games = AllGame::get();
            $countries = Country::all();
            $zones = TimeZone::all();

            $detail = $team->info()->first();
            $detail->zone = ($detail->time_zone_id > 0) ? TimeZone::find($detail->time_zone_id)->zone_name : '';

            $fields = CustomField::all();
            $prefs  = $team->prefs()->first();

            $status = $team->publicURL()->first();
            //return $status;

            return view('pages.settings', compact('id', 'team', 'managers', 'public', 'manage', 'games', 'countries', 'detail', 'zones', 'fields', 'prefs', 'status'));
          }
          return view('errors/404');
        }
    // end show settings page

    // start  league settings page
        public function leagueSetting($id, $ldid)
        {

          $user = Auth::user();
          $uid  = session('id') ? session('id') : Auth::user()->id;
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
                return redirect('check');
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
            session()->flash('active', 2);
            session()->flash('sub', 1);
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
            session()->flash('active', 2);
            session()->flash('sub', 2);
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
            try
            {
                $type  = $request->teamleague;
                $email = $request->email;
                $fname = $request->fname;
                $user  = User::where('email', $email)->first();
                $owner = Auth::user();
                $uid   = 0;

                $name = ( $type == 'team' ) ? Team::find($id)->teamname : League::find($id)->league_name;

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

                $mail = new Manager($owner->name, $owner->email, $name, $email, $type);
                Mail::to($email)->send($mail);

                if( $type == 'team' )
                {
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
                    $tuser = DivisionManager::checkIfManager($id, $user->id);

                    if( $tuser == '' )
                        $tuser = DivisionManager::newManager($id, $user->id);
                }

                $uid = $tuser->id;
                return $uid;
            }
            catch(\Exception $e)
            {
                return -1;
            }
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
            session()->flash('active', 3);
            return Redirect::back();
        }
    // end delete team manager

        public function updateInfo(Request $request)
        {
          $tid = $request->id;
          $team = Team::find($tid);
          $team->update($request->only('teamname', 'country', 'zip', 'all_games_id'));
          $team->info()->update($request->except('_token', 'country', 'zip', 'teamname', 'all_games_id'));
          session()->flash('success', 'Team details updated successfully.');
          session()->flash('active', 1);
          return redirect()->back();
        }

        public function addFields(Request $request)
        {
          CustomField::create($request->all());
          session()->flash('success', 'Field successfully added.');
          session()->flash('active', 4);
          return redirect()->back();
        }

        public function getField($fid)
        {
          return CustomField::find($fid);
        }

        public function updateField(Request $request)
        {
          $id = $request->id;
          CustomField::find($id)->update($request->except('id', '_token'));
          session()->flash('success', 'Field successfully updated.');
          session()->flash('active', 4);
          return redirect()->back();
        }

        public function deleteField($fid)
        {
          CustomField::find($fid)->delete();
          session()->flash('success', 'Field successfully removed.');
          session()->flash('active', 4);
          return redirect()->back();
        }

        public function updatePreferences(Request $request)
        {
          $team = Team::find($request->id);
          if($request->game_notify == '')
            $request['game_notify'] = 0;
          if($request->event_notify == '')
            $request['event_notify'] = 0;
          if($request->availability == '')
            $request['availability'] = 0;
          if($request->item_tracking_privacy == '')
            $request['item_tracking_privacy'] = 0;
          if($request->non_player_item_tracking == '')
            $request['non_player_item_tracking'] = 0;
          if($request->payment_tracking_privacy == '')
            $request['payment_tracking_privacy'] = 0;
          if($request->non_player_payment_tracking == '')
            $request['non_player_payment_tracking'] = 0;
          if($request->date_format == '')
            $request['date_format'] = 0;
          if($request->assignment_tracking == '')
            $request['assignment_tracking'] = 0;
          if($request->score_tracking == '')
            $request['score_tracking'] = 0;

          $team->prefs()->update($request->except('id', '_token'));
          $team->update(['team_color_first' => $request->color_scheme]);
          session()->flash('success', 'Site preferences updated.');
          session()->flash('active', 5);
          return redirect()->back();
        }

    public function addURL($id, Request $request)
    {
      $team = Team::find($id);
      $team->publicURL()->create($request->all());
      session()->flash('success', 'Your will receive a confirmation mail when your public URL will be activated.');
      session()->flash('active', 6);
      return redirect()->back();
    }

    public function updateUrlStatus($id, Request $request)
    {
      PublicUrl::find($id)->update($request->all());
    }

    public function checkUrl($url)
    {
      return PublicUrl::where('team_url', $url)->count();
    }
}
