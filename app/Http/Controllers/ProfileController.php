<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\Member;

class ProfileController extends Controller
{
    public function index($id)
    {
    	$name=Member::where('team_name',$id)->select('firstname')->get();
    	
    	$email=Member::where('team_name',$id)->select('email')->get();
    	// $phoneno=
    	// $gender=
    	// $address=

    	return view('profile',compact('name','email'));
    }
}
