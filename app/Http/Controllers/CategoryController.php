<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Ctg;
use TeamSnap\Team;
use TeamSnap\TeamCtg;

class CategoryController extends Controller
{
    public function store($id, Request $request)
    {
      $teamid = Team::where('teamname',$id)->select('id')->get()->first();
      $ctgs   = new Ctg;
      $ctgs->name  = $request->get('ctg_name');
      $ctgs->save();
       
      $ctg_id = $ctgs->id;
      $team_ctgs = new TeamCtg(array(
      	'team_id' => $teamid->id,
      	'ctg_id'  => $ctg_id,
      ));
      $team_ctgs->save();
      return redirect($id.'/members');
    }
}
