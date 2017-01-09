<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Team;
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
