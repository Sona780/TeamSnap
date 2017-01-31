<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use TeamSnap\User;
use Image;

class UserController extends Controller
{
    public function index($id)
    {
    	$user = User::where('id',$id)->get()->first();
    	return view('userprofile',['user'=>$user]);
    }

    public function store($id, Request $request)
    {
      if($request->hasFile('avatar'))
       {

       	   $avatars = $request->file('avatar');
       	   $filename = time().'.'.$avatars->getClientOriginalExtension();
       	   Image::make($avatars)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
           $avatar = User::where('id',$id)->select('avatar')->get()->first();
           $avatar->avatar=$filename;
           $avatar->save();
           User::where('id',$id)->update(['avatar' => $avatar->avatar]);
          
       }
       return redirect($id.'/userprofile');
    }
}
