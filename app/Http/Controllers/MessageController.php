<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use TeamSnap\Userdetail;
use TeamSnap\Email;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;


class MessageController extends Controller
{
   public function index($id)
   {
      $teamid = Team::where('teamname',$id)->value('id');
   	  $members = TeamUser::where('team_id',$teamid)->get();
      $authid = Auth::user()->id;
      $emails = Email::leftJoin('')where('receiver_id', $authid)->where('team_id',$teamid)->get();
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
