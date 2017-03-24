<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Stat;
use TeamSnap\Team;

class RecordsController extends Controller
{
    public function index($id)
    {
    	return view ('records');
    }

    public function list_stats($id)
    {
    	$teamid = Team::where('teamname', $id)->value('id');
    	$stats = Stat::where('team_id',$teamid)->get();
    	return view('list_stats',compact('stats'));
    }

    public function store_stats($id, Request $request)
    {
      $teamid = Team::where('teamname', $id)->value('id');
      $stats  = new Stat(array(
         'stats_name'   =>  $request->get('stats_name'),
         'acronym_name' =>  $request->get('acronym_name'),
         'formula'      =>  $request->get('formula'),
         'stats_group'  =>  $request->get('stats_group'),
         'team_id'      =>  $teamid,
      ));
      $stats->save();
      return redirect($id.'/records/list_stats');
    }
}
