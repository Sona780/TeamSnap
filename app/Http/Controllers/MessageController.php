<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use TeamSnap\Member;

class MessageController extends Controller
{
   public function index($id)
   {
   	  return view('message',["id"=>$id]);
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
   	 $mails= Member::where('team_name',$id)->select('email')->get();
     
   	 $mail='pandey12@gmail.com';
   	 foreach($mails as $mail){
     $email=$mail->email;

   	 $mailer->to($email)
            ->queue(new \TeamSnap\Mail\Mymail($request->input('title')));
      }          
     
     return redirect($id.'/messages');        
   }

}
