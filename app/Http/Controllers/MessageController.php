<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use TeamSnap\Member;
use TeamSnap\Email;
use Auth;


class MessageController extends Controller
{
   public function index($id)
   {
   	  $members = Member::where('team_name',$id)->get();

      return view('message',["id"=>$id,'members'=>$members]);
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
        //      for reuse the data
        //       $raw_data = // query to get the data from the DB
        //       $data = unserialize( $raw_data );
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
