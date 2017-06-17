<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\Team;
use TeamSnap\League;
use TeamSnap\User;
use TeamSnap\UserDetail;

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

    public function ownerDelete($id)
    {
      $user = User::find($id);
      session()->flash('success', $user->name.' has been deleted successfully.');
      $user->delete();
      Team::where('team_owner_id', $id)->delete();
      return redirect()->back();
    }

    public function ownerAdd(Request $request)
    {
      $request['password'] = bcrypt(rand());
      $request['name'] =$request->firstname;
      $user = User::create($request->all());
      $request['users_id'] = $user->id;
      UserDetail::create($request->all());
      session()->flash('success', $request->email.' has been added as an owner.');
      return redirect()->back();
    }

    public function ownerData($id)
    {
      $user = User::find($id);
      $user->detail = UserDetail::where('users_id', $user->id)->first();
      return $user;
    }

    public function ownerUpdate(Request $request)
    {
      $id = $request->user_id;
      $request['name'] = $request->firstname;
      User::find($id)->update($request->only('email', 'name'));
      UserDetail::where('users_id', $id)->update($request->only('firstname', 'lastname', 'mobile'));
      session()->flash('success', $request->name.' '.$request->lastname.' details has been updated.');
      return redirect()->back();
    }
}
