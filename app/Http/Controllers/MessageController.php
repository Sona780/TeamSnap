<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use TeamSnap\Userdetail;
use TeamSnap\Email;
use Auth;
use TeamSnap\Team;


class MessageController extends Controller
{
   public function index($id)
   {
      $teamid = Team::where('teamname',$id)->select('id')->get()->first();
   	  $members = Userdetail::where('team_id',$teamid->id)->get();
      $authid = Auth::user()->id;
      $emails = Email::where('sender_id', $authid)->select('receiver_id')->get();
      return view('message',["id"=>$id,'members'=>$members,'emails'=>$emails]);
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
     $mails = Input::get('val');
     $emailinfo = new Email;
     $emailinfo->title = $request->input('title');
     $emailinfo->body  = $request->input('title');
     $emailinfo->sender_id = Auth::user()->id;
     $emailinfo->receiver_id = serialize( json_encode( $mails ) );
     $emailinfo->save();
     //$data = unserialize( $emailinfo->receiver_id );
     $i = 0; 
     foreach($mails as $mail)
     {
     $m = Member::where('id', $mail)->select('email')->get()->first();
     $email=$m->email;
     $mailer->to($email)
            ->queue(new \TeamSnap\Mail\Mymail($request->input('title'),$request->input('body')));
      $i++;     
     }
    
        
   }

}
