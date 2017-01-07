<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

use DB;
use App\Addmember;

class AddmemberController extends Controller
{
    
    public function index()
    {
    	return view('addmember');
    }
    
    public function store(Request $request)
    {
    	Addmember::create($request->all());
    	return redirect('/myhome');
    }
    
    public function show()
    {
          $memberdetails=DB::table('addmembers')->get();
           return view('member',compact('memberdetails'));
    }
    public function api()
    {

    }
    
}
