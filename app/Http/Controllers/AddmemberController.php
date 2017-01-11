<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\Http\Requests;
use Auth;

use DB;
use TeamSnap\Member;
use TeamSnap\Team;
use Illuminate\Support\Facades\Input;

class AddmemberController extends Controller
{
    
    public function index()
    {
    	$teams = DB::table('teams')->get();
    
      return view('addmember',compact('teams'));
    }
    
    public function store(Request $request)
    {
    	 
        $data=Input::get('ch');
            
         if($data==["1"])
                
            {
          
             $study = new Member(array(
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
            'flag'=>false,                         
            'email'=>$request->get('email'),
           
            
             ));
            
          $study->save();
          
          return redirect('team_setup'); 
          
           }
     else
                
            {
          
            $study = new Member(array(
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
             'flag'=>true,                          
            'email'=>$request->get('email'),
           
            
             ));
            
          $study->save();
          
          return redirect('team_setup'); 
          
           }


    }
    
    public function show($id)
    {
          $memberdetails=DB::table('members')->get();
          DB::table('members')->update(['team_id' => $id]);
          $teammembers = Member::where('team_id', $id)->get();
          return view('member',compact('teammembers'));
    }
    public function api()
    {
         
    }
    
}
