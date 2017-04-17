<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\UserDetail;
use TeamSnap\AllGame;
use TeamSnap\TeamInfo;
use TeamSnap\AccessManage;

use Image;
use Redirect;

class TeamController extends Controller
{
    // start create new teams
        public function show()
        {
          $gms   = AllGame::all();

          $games = [];
          foreach ($gms as $g)
          {
            $games[$g->id] = $g->game_name;
          }

          return view('pages.create-team', compact('games'));
        }
    // end create new teams

    // start save new team
        public function store(Request $request)
        {
          $name = $request->teamname;
          $this->validate($request, [
              'teamname' => 'required',
              'zip'      => 'required',
            ], [
              'teamname.required' => 'The team name is required.',
            ]
          );

          $path = '/images/teams/default.jpg';

          if($request->hasFile('logo'))
          {
            $teamlogo = $request->file('logo');
            $filename = time().'.'.$teamlogo->getClientOriginalExtension();
            $path     = '/images/teams/'.$filename;

            Image::make($teamlogo)->resize(300,300)->save(config('paths.public_html').$path);
          }

          $request['team_logo'] = $path;
          $request['team_owner_id'] = Auth::user()->id;

          $team = Team::where('teamname', $name)->first();

          if( $team != '' )
          {
            if( $team->team_owner_id == 0 )
              $team->update($request->except('_token'));
            else
            {
              session()->flash('error', 'A team with same name already exists.');
              return Redirect::back();
            }
          }
          else
            $team = Team::create($request->all());

          TeamInfo::create(['team_id' => $team->id, 'uniform' => '/images/uniforms/default.png']);
          AccessManage::newTeam($team->id, 0, 0);
          AccessManage::newTeam($team->id, 1, 1);

          return redirect($team->id.'/dashboard');
        }
    // end save new team

    // start edit a team info
        public function edit($tid)
        {
            $team  = Team::find($tid);
            $uid   = Auth::user()->id;
            $user  = UserDetail::where('users_id', $uid)->first()->manager_access;
            $ch    = TeamUser::where('teams_id', $tid)->where('users_id', $uid)->get();

            if( $team == '' || ($uid != $team->team_owner_id && ($user != 2 || $ch->count() == 0)) )
                return view('errors/404');

            $gms   = AllGame::all();

            $games = [];
            foreach ($gms as $g)
                $games[$g->id] = $g->game_name;

            return view('pages.edit-team', compact('games', 'team', 'tid'));
        }
    // end edit a team info

    // start update team info
        public function update(Request $request)
        {
            $team = Team::find($request->id);
            if( $request->hasFile('logo') )
            {
                $teamlogo = $request->file('logo');
                $filename = time().'.'.$teamlogo->getClientOriginalExtension();
                $path     = '/images/teams/'.$filename;

                Image::make($teamlogo)->resize(300,300)->save(config('paths.public_html').$path);

                $request['team_logo'] = $path;
            }

            $team->update($request->all());

            return redirect('home');
        }
    // end update team info

    // start delete team
        public function delete($tid)
        {
            Team::find($tid)->delete();

            return redirect('home');
        }
    // end delete team

    // start get all teams of current user
        public function getAll()
        {
            $uid     = Auth::user()->id;
            $manager = UserDetail::where('users_id', $uid)->first()->manager_access;

            if( $manager == 1 )
               return Team::where('team_owner_id', Auth::user()->id)->get();
            else
               return TeamUser::getUserTeams($uid);
        }
    // end get all teams of current user

    // start get all team of a member
        public function getMemberTeams()
        {
            $uid   = Auth::user()->id;
            $teams = TeamUser::where('users_id', $uid)->leftJoin('teams', 'teams.id', 'team_users.teams_id')->select('teams.id', 'teams.teamname')->get();
            return $teams;
        }
    // end get all team of a member

    // start update team info
        public function updateInfo($id, Request $request)
        {
          $team = TeamInfo::where('team_id', $id);
          $data = [];

          if( $request->detail != '' )
          {
            $data['detail'] = $request->detail;
            $team->update(['detail' => $request->detail]);
          }
          if( $request->hasFile('uniform') )
          {
            $uniform = $request->file('uniform');
            $filename = time().'.'.$uniform->getClientOriginalExtension();
            $path     = '/images/uniforms/'.$filename;

            Image::make($uniform)->resize(300,300)->save(config('paths.public_html').$path);

            $team->update(['uniform' => $path]);
          }
          return redirect($id.'/dashboard');
        }
    // end
}
