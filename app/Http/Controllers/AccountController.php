<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use TeamSnap\User;
class AccountController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $account = User::findOrFail($id);
        
    	return view('account',compact('account'));
    }
  
     public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect('account');
                        
    }

}
