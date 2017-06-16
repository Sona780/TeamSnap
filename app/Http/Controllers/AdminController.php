<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Team;
use TeamSnap\League;
use TeamSnap\User;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
	  $owners  = User::owners();
      $teams   = Team::count();
      $leagues = League::count();
      $users   = User::count()-1;
      return view('admin.home', compact('owners', 'teams', 'leagues', 'users'));
    }

    public function ownerHome($id)
    {
      session(['id' => $id]);
      return redirect('home');
    }
}
