<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use TeamSnap\Member;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
   public function index($id)
   {
   	  $members = Member::where('team_name',$id)->get();
      return view('message',["id"=>$id,'members'=>$members]);
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
     $members = Member::where('team_name',$id)->get();
     $select_all = $request->get('select_all');
     $mails= Member::where('team_name',$id)->select('email')->get();  
    
    
   	 foreach($mails as $mail)
     {
     $email=$mail->email;
     $mailer->to($email)
            ->queue(new \TeamSnap\Mail\Mymail($request->input('title')));
     }      

     
     return redirect($id.'/messages');        
   }

}
