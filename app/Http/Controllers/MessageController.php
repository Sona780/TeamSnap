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
use TeamSnap\User;


class MessageController extends Controller
{
   public function index($id)
   {
      $user_id = Auth::user()->id;
       $team_name = Team::where('team_owner_id',$user_id)->value('teamname');
       if($team_name == '' || $team_name== NULL)
       {
        return view('errors/404');
       }
       else
       {
          $teamid = Team::where('teamname',$id)->value('id');
       	  $members = TeamUser::leftJoin('user_details','team_users.user_id','=','user_details.user_id')->where('team_users.team_id',$teamid)->get();

          $authid = Auth::user()->id;
          $emails = Email::leftJoin('users','emails.sender_id','=','users.id')
                         // ->where('emails.receiver_id', $authid)
                         // ->where('emails.team_id',$teamid)
                         ->get();
           
          return view('message',["id"=>$id,'members'=>$members,'emails'=>$emails]);
       }
   }
   public function sendmail($id,Request $request,Mailer $mailer)
   {
    
    $mail = Input::get('val');

    dd($mail);
    for($i=0;$i<sizeof($mail);$i++)
     {
           $emailinfo[$i]= new Email;
           $emailinfo[$i]->title = $request->input('title');
           $emailinfo[$i]->body  = $request->input('body');
           $emailinfo[$i]->sender_id = Auth::user()->id;
           $emailinfo[$i]->receiver_id = $mail[$i];
           $emailinfo[$i]->save();
           $m = User::where('id', $mail)->select('email')->get()->first();
           $email=$m->email;
           $mailer->to($email)
                  ->queue(new \TeamSnap\Mail\Mymail($request->input('title'),$request->input('body')));

     }

    

   }


}
