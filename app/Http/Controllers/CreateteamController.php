<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Auth;
use Request;
use App\Createteam;
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
