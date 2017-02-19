<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Ctg;
use TeamSnap\Team;

class CategoryController extends Controller
{
    public function store($id, Request $request)
    {
      $teamid = Team::where('teamname',$id)->select('id')->get()->first();
      $ctgs   = new Ctg;
      $ctgs->name  = $request->get('ctg_name');
      $ctgs->team_id = $teamid->id;
      $ctgs->save();
      return redirect($id.'/members');
    }
}
