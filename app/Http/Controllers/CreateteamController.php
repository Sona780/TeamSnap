<?php
namespace TeamSnap\Http\Controllers;

use Image;
use Auth;

use Illuminate\Http\Request;

//use TeamSnap\Http\Requests;
use TeamSnap\Team;
use TeamSnap\AllGame;

class CreateteamController extends Controller
{
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

    public function store(Request $request)
    {
      $name = $request->teamname;
      $this->validate($request, [
          'teamname' => 'required|unique:teams,teamname',
          'zip'      => 'required|digits_between:6,6',
        ], [
          'teamname.required' => 'The team name is required.',
          'teamname.unique'   => 'A team with same name already exists.',
        ]
      );

      $uid  = Auth::user()->id;

      $path = '/images/teams/default.jpg';

      if($request->hasFile('logo'))
      {
        $teamlogo = $request->file('logo');
        $filename = time().'.'.$teamlogo->getClientOriginalExtension();
        $path     = '/images/teams/'.$filename;

        Image::make($teamlogo)->resize(300,300)->save(config('paths.public_html').$path);
      }

      $request['team_logo'] = $path;
      $request['team_owner_id'] = $uid;

      $team = Team::create($request->all());
      return redirect($team->id.'/dashboard');
    }

}
