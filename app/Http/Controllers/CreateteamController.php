<?php

namespace TeamSnap\Http\Controllers;


use TeamSnap\Http\Requests;
use Auth;
use Request;
use TeamSnap\Createteam;
use DB;

class CreateteamController extends Controller
{
    public function index()
    {
    	return view('createteam');
    }
  
      public function store()
    {
        $input = Request::all();
        Createteam::create($input);
        //$item= DB::table('createteams')->latest()->pluck('teamname');
       // return $item;
        return redirect('/team_setup');
    }
   
   
   public function api()
   {
    
   }
}
