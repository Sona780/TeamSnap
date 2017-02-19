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
   	  $members = TeamUser::leftJoin('user_details','team_users.user_id','=','user_details.user_id')->where('team_users.team_id',$teamid)->get();
      $authid = Auth::user()->id;
      $emails = Email::leftJoin('users','emails.sender_id','=','users.id')->where('emails.receiver_id', $authid)->where('emails.team_id',$teamid)->get();

      return view('message',["id"=>$id,'members'=>$members,'emails'=>$emails]);
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
            $mails = Input::get('val');
     $emailinfo = new Email;
     $emailinfo->title = $request->input('title');
     $emailinfo->body  = $request->input('body');
     $emailinfo->sender_id = Auth::user()->id;
      foreach($mails as $mail)
     {
          $emailinfo->receiver_id =  $mail ;
     $emailinfo->save();



     $m = User::where('id', $mail)->select('email')->get()->first();
     $email=$m->email;
     $mailer->to($email)
            ->queue(new \TeamSnap\Mail\Mymail($request->input('title'),$request->input('body')));
      $i++;
    }
    

   }


}
