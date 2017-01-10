<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\Http\Requests;
use Auth;

use DB;
use TeamSnap\Member;
use TeamSnap\Team;

class AddmemberController extends Controller
{
    
    public function index()
    {
    	return view('addmember');
    }
    
    public function store(Request $request)
    {
    	Member::create($request->all());
        
    	return view('/addmember');
    }
    
    public function show($id)
    {
          $memberdetails=DB::table('members')->get();
          $teammembers = Member::where('team_id', $id)->get();
          
          return view('member',compact('teammembers'));
    }
    public function api()
    {
         
    }
    
}
