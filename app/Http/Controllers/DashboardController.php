<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use Auth;

class DashboardController extends Controller
{
   
   public function index()
   {

   		$uid = Auth::user()->id;
   		$users = Team::where('user_id', $uid)->get();
   	    return view('dashboard',compact('users'));
   }
   
   public function api()
   {
   	
   }

}
