<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\League;
use TeamSnap\Team;
use TeamSnap\TeamInfo;
use TeamSnap\User;
use TeamSnap\UserDetail;
use TeamSnap\LeagueTeam;
use TeamSnap\LeagueDivision;
use TeamSnap\LeagueLocation;
use TeamSnap\LeagueAccessManage;
use TeamSnap\DivisionManager;

use TeamSnap\Mail\LeagueInviteMail;
use Mail;

use Auth;
use TeamSnap\Http\ViewComposer\UserComposer;

use TeamSnap\Http\Controllers\DashboardController;

class LeagueController extends Controller
{
    // start create new league
        public function create(Request $request)
        {
        	$request['user_id'] = Auth::user()->id;
        	$league = League::create($request->all());
            LeagueDivision::newLeague($request->league_name, $league->id);
            LeagueAccessManage::newLeague($league->id);
            session()->flash('home', 'league');
            session()->flash('success', 'League successfully created!!');
        	return redirect('home');
        }
    // end create new league

    // start show division section
        public function showDetail($id, $ldid)
        {
            $user = Auth::user();
            $uid  = $user->id;
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
}
