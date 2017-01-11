<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use \TeamSnap\Team;
use Auth;

class DashboardController extends Controller
{

   public function index($id)
    {
      
       return view('dashboard'); 
       


        
    }
}
