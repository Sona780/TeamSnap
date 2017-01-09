<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Auth;
use Request;
use App\Team;
use DB;


class CreateteamController extends Controller
{
    public function index()
    {
    	return view('createteam');
    }
  
      public function store()
    {
      $inputs = new Team(Request::all());
      Auth::user()->teams()->save($inputs);
    
      return redirect('/team_setup');
           // return $users;
      
     // return view('dashboard')->with('users', $users);
    }
   
   
   public function api()
   {
    
   }
   
}
