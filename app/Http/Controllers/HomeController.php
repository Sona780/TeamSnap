<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    	
     //   $uid = Auth::user()->id;
   		// $tables = Member::where('user_id', $uid)->get();
   	 //    return view('dashboard',compact('users'));

    	return view('myhome');
    }
}
