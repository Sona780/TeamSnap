<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Member;
use TeamSnap\Team;

class HomeController extends Controller
{
   public function index()
   {

          $uid = Auth::user()->id;
   		    $teams = Team::where('user_id', $uid)->get();
   	      return view('home', compact('teams'));

   }

   public function api()
   {

   }
}
