<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\Member;

class HomeController extends Controller
{
    public function index($id)
    {
    	
       return view('myhome'); 
       


        
    }
}
