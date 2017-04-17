<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\League;
use TeamSnap\Team;
use TeamSnap\LeagueTeam;
use TeamSnap\LeagueDivision;
use TeamSnap\LeagueLocation;
use TeamSnap\LeagueAccessManage;

use TeamSnap\Mail\LeagueInviteMail;
use Mail;

use Auth;
use TeamSnap\Http\ViewComposer\UserComposer;

class LeagueController extends Controller
{
    //
    public function create(Request $request)
    {
    	$request['user_id'] = Auth::user()->id;
    	$league = League::create($request->all());
        LeagueDivision::create(['division_name' => $request->league_name, 'league_id' => $league->id, 'parent_id' => 0]);
        LeagueAccessManage::newLeague($league->id);
    	return redirect('home');
    }

    public function showDetail($id)
    {
        $uid = Auth::user()->id;
        $ch  = League::find($id)->user_id;

        if( $uid != $ch )
          return view('errors/404');

    	$league = League::find($id);
        $ldid = LeagueDivision::RootDivision($id)->first()->id;
    	$composerWrapper = new UserComposer( $id, 'league' );
      	$composerWrapper->compose();

      	$lteams = LeagueTeam::getTeams($ldid);
      	$divisions = LeagueDivision::where('parent_id', $ldid)->get();
        $prev = [];
        $name = $league->league_name;

    	return view('league.detail', compact('id', 'league', 'lteams', 'divisions', 'ldid', 'prev', 'name'));
    }

    public function showDivision($id, $ldid)
    {
        $uid = Auth::user()->id;
        $ch  = League::find($id)->user_id;

        if( $uid != $ch )
          return view('errors/404');

        $league = League::find($id);

        $composerWrapper = new UserComposer( $id, 'league' );
        $composerWrapper->compose();

        $prev = [];
        $i = 0;
        $parent = LeagueDivision::find($ldid)->parent_id;
        while($parent != 0)
        {
            $div = LeagueDivision::find($parent);
            $prev[$i]['name'] = $div->division_name;
            $prev[$i++]['id'] = $div->id;
            $parent = $div->parent_id;
        }
        $prev = array_reverse($prev);

        $lteams = LeagueTeam::getTeams($ldid);
        $divisions = LeagueDivision::where('parent_id', $ldid)->get();
        $name = LeagueDivision::find($ldid)->division_name;
        return view('league.detail', compact('id', 'league', 'lteams', 'divisions', 'ldid', 'prev', 'name'));
    }


    public function saveTeam($id, Request $request)
    {
        $opp  = Team::where('teamname', $request->team_name)->first();
        if( $opp == '' )
            $opp = Team::newTeam($request->team_name, 1);

        $request['team_id'] = $opp->id;
    	LeagueTeam::create($request->all());
        $ldid = $request->league_division_id;

        $user   = Auth::user();
        $league = League::find($id);

        $email = new LeagueInviteMail($user->name, $user->email, $league->league_name);
        Mail::to($request->owner_email)->send($email);

        if( LeagueDivision::find($ldid)->parent_id == 0 )
           return redirect('league/'.$id.'/detail');
        else
            return redirect('league/'.$id.'/division/'.$ldid);
    }

    public function saveDivision($id, Request $request)
    {
    	LeagueDivision::create($request->all());
        $ldid = $request->parent_id;
        if( LeagueDivision::find($ldid)->parent_id == 0 )
    	   return redirect('league/'.$id.'/detail');
        else
            return redirect('league/'.$id.'/division/'.$ldid);
    }

    public function deleteDivision($id, $did)
    {
        $div  = LeagueDivision::find($did);
        $ldid = $div->parent_id;
        $div->delete();

        if( LeagueDivision::find($ldid)->parent_id == 0 )
            return redirect('league/'.$id.'/detail');
        else
            return redirect('league/'.$id.'/division/'.$ldid);
    }

    public function deleteTeam($id, $tid)
    {
        $team = LeagueTeam::find($tid);
        $ldid = $team->league_division_id;
        $team->delete();
        if( LeagueDivision::find($ldid)->parent_id == 0 )
           return redirect('league/'.$id.'/detail');
        else
            return redirect('league/'.$id.'/division/'.$ldid);
    }

    public function getDivisionTeams($did)
    {
        $data = [];
        $data['teams'] = LeagueTeam::getDivisionTeams($did);
        $data['loc']   = LeagueLocation::where('league_division_id', $did)->select('id', 'loc_name')->get();
        return $data;
    }
}
