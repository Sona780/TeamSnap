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
      $games = AllGame::all();

    	return view('pages.create-team', compact('games'));
    }

    public function store(Request $request)
    {
      $name = $request->teamname;
      $this->validate($request, [
          'teamname' => 'required|unique:teams,teamname',
          'zipcode'  => 'required|digits_between:6,6',
        ], [
          'teamname.required' => 'The team name is required.',
          'teamname.unique'   => 'A team with same name already exists.',
        ]
      );

      $uid  = Auth::user()->id;
      $team = new Team;


      $team->teamname          = $request->teamname;
      $team->all_games_id      = $request->sport;
      $team->country           = $request->country;
      $team->zip               = $request->zipcode;
      $team->team_color_first  = $request->team_color_first;
      $team->team_color_second = $request->team_color_second;
      $team->team_owner_id     = $uid;

      $path = '/images/teams/default.jpg';

      if($request->hasFile('team_logo'))
      {
        $teamlogo = $request->file('team_logo');
        $filename = time().'.'.$teamlogo->getClientOriginalExtension();
        $path     = '/images/teams/'.$filename;

        Image::make($teamlogo)->resize(300,300)->save(config('paths.public_html').$path);
      }

      $team->team_logo = $path;
      $team->save();

      return redirect($team->id.'/dashboard');
    }

}
