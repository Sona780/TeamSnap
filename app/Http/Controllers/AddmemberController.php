<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\Http\Requests;
use Auth;

use DB;
use TeamSnap\Member;

class AddmemberController extends Controller
{
    
    public function index()
    {
    	return view('addmember');
    }
    
    public function store(Request $request)
    {
    	Member::create($request->all());
    	return redirect('/team_setup');
    }
    
    public function show()
    {
          $memberdetails=DB::table('members')->get();
           return view('member',compact('memberdetails'));
    }
    public function api()
    {
         
    }
    
}
