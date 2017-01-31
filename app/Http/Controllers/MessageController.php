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
   	  return view('message',["id"=>$id]);
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
    $select_all = Input::get('select_all');
    dd($select_all);
   	$mails= Member::where('team_name',$id)->where('message_chk',1)->select('email')->get();
     
   	 foreach($mails as $mail)
     {
     $email=$mail->email;
     $mailer->to($email)
            ->queue(new \TeamSnap\Mail\Mymail($request->input('title')));
      }          
     
     return redirect($id.'/messages');        
   }

}
