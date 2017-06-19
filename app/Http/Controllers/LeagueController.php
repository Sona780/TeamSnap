<?php

namespace Org4Leagues\Http\Controllers;

use Illuminate\Http\Request;

use Org4Leagues\League;
use Org4Leagues\Team;
use Org4Leagues\TeamInfo;
use Org4Leagues\User;
use Org4Leagues\UserDetail;
use Org4Leagues\LeagueTeam;
use Org4Leagues\LeagueDivision;
use Org4Leagues\LeagueLocation;
use Org4Leagues\LeagueAccessManage;
use Org4Leagues\DivisionManager;
use Org4Leagues\AccessManage;
use Org4Leagues\SitePref;

use Org4Leagues\Mail\LeagueInviteMail;
use Mail;

use Auth;
use Org4Leagues\Http\ViewComposer\UserComposer;

use Org4Leagues\Http\Controllers\DashboardController;

class LeagueController extends Controller
{
    // start create new league
        public function create(Request $request)
        {
        	$request['user_id'] = session('id') ? session('id') : Auth::user()->id;
        	$league = League::create($request->all());
            LeagueDivision::newLeague($request->league_name, $league->id);
            LeagueAccessManage::newLeague($league->id);
            session()->flash('home', 'league');
            session()->flash('success', 'League successfully created !!');
        	return redirect('home');
        }
    // end create new league

    // start get league details
        public function getDetail($lid)
        {
            return League::find($lid);
        }
    // end get league details

    // start update league details
        public function update($lid, Request $request)
        {
            League::find($lid)->update($request->except('__token'));
            session()->flash('home', 'league');
            session()->flash('success', 'League details updated successfully !!');
            return redirect()->back();
        }
    // end update league details

    // start delete league
        public function delete($lid)
        {
            League::find($lid)->delete();
            session()->flash('home', 'league');
            session()->flash('success', 'League successfully deleted !!');
            return redirect()->back();
        }
    // end delete league

    // start show division section
        public function showDetail($id, $ldid)
        {
            $user = Auth::user();
            $uid  = session('id') ? session('id') : Auth::user()->id;
            $ch   = League::find($id)->user_id;
            $man  = DivisionManager::check($uid, $ldid);

            if( $uid != $ch && $man == '' )
              return view('errors/404');

            $composerWrapper = new UserComposer( $id, 'league' );
            $composerWrapper->compose();

        	$league    = League::find($id);
          	$lteams    = LeagueTeam::getTeams($ldid);
          	$divisions = LeagueDivision::where('parent_id', $ldid)->get();

            $d    = new DashboardController();
            $prev = $d->path($ldid);
            $curr = LeagueDivision::find($ldid)->division_name;

        	return view('league.division', compact('id', 'league', 'lteams', 'divisions', 'ldid', 'prev', 'ldid', 'curr'));
        }
    // end show division section

    // start save new league team
        public function saveTeam($id, $ldid, Request $request)
        {
            $mail  = $request->owner_email;
            $fname = $request->owner_first_name;
            $lname = $request->owner_last_name;
            $tname = $request->team_name;

            $uid = User::where('email', $mail)->first();

            if( $uid != '' )
              $uid = $uid->id;
            else
            {
              $u   = User::addUserFromLeague($fname, $mail, 0);
              $uid = $u->id;
              UserDetail::addUserFromLeague($uid, $fname, $lname, 1);
            }

            $t = Team::where('teamname', $tname)->where('team_owner_id', $uid)->first();
            if($t == '')
            {
              $t = Team::newLeagueTeam($tname, $uid, 1);
              TeamInfo::create([ 'team_id' => $t->id ]);
              AccessManage::newTeam($t->id, 0, 0);
              AccessManage::newTeam($t->id, 1, 1);
              SitePref::create(['team_id' => $t->id, 'color_scheme' => '#03A9F4']);
            }
            $request['team_id'] = $t->id;
        	LeagueTeam::create($request->all());

            $user   = Auth::user();
            $league = League::find($id);

            $email = new LeagueInviteMail($user->name, $user->email, $league->league_name);
            Mail::to($mail)->send($email);
            return redirect('l/'.$id.'/d/'.$ldid.'/detail');
        }
    // end save new league team

    // start save new league division
        public function saveDivision($id, $ldid, Request $request)
        {
        	LeagueDivision::create($request->all());
            return redirect('l/'.$id.'/d/'.$ldid.'/detail');
        }
    // end save new league division

    // start delete league division
        public function deleteDivision($id, $ldid, $did)
        {
            $div  = LeagueDivision::find($did);
            $div->delete();
            return redirect('l/'.$id.'/d/'.$ldid.'/detail');
        }
    // end delete league division

    // start delete league team
        public function deleteTeam($id, $ldid, $tid)
        {
            $team = LeagueTeam::find($tid);
            $team->delete();
            return redirect('l/'.$id.'/d/'.$ldid.'/detail');
        }
    // end delete league team

    // start get teams of a league division
        public function getDivisionTeams($did)
        {
          return LeagueTeam::getDivisionTeams($did);
        }
    // end get teams of a league division

        public function getLeagues()
        {
            $user = Auth::user();

        }
}
