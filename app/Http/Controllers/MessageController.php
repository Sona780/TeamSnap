<?php

namespace TeamSnap\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use \Carbon\Carbon;

use TeamSnap\Userdetail;
use Auth;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\User;

use TeamSnap\Email;
use TeamSnap\EmailUser;
use TeamSnap\EmailInfo;

use TeamSnap\Mail\SendMail;


class MessageController extends Controller
{
    // start load all inbox & out box email
    public function show($id)
    {
      $uid  = Auth::user()->id;
      $avatar = Userdetail::getUserAvatar($uid);
      //return $avatar;

      //get team info
      $ch   = Team::find($id);

      // if team doesnot exists or not a team of currently logged in user
      /*if($ch == NULL || $ch->team_owner_id != $uid)
        return view('errors/404');

      // if team exists and a team of currently logged in user
      else*/
      {
        //get member details
     	  $members = TeamUser::getMemberDetails($id);

        // get all outbox mails
        $outbox  = EmailInfo::outbox($uid, $id);

        // get id of all different mails send by user
        $smails  = EmailInfo::getDiffSendMails($uid);

        // get recipients of mails
        foreach ($smails as $mail)
        {
          $mid = $mail->emails_id;

          $recipients[$mid] = EmailUser::getRecipients($mid, $uid);
        }


        $rmail = Email::getUserMails($uid, $id);
        $i     = 0;

        $inbox = [];

        foreach ($rmail as $mail)
        {
          $reply       = EmailInfo::getAllMails($mail->emails_id);

          if( ( $reply->count() > 1 ) || ( $reply->count() == 1 && $reply->first()->sender_id != $uid ) )
          {
            $inbox[$i]['mid']         = $mail->emails_id;
            $inbox[$i]['musers']      = EmailUser::getMailUsers($mail->emails_id);
            $inbox[$i]['reply']       = $reply;
            $inbox[$i]['subject']     = $reply->last()->subject;
            $inbox[$i]['last_reply']  = $reply->last()->send_at;
            $inbox[$i]['status']      = (strtotime($inbox[$i]['last_reply']) > strtotime($mail->last_checked_at)) ? 'new' : '';
            $i++;
          }
        }

        $inbox = collect(array_values(array_sort($inbox, function($value){
          return $value['last_reply'];
        })))->reverse();

        //return $inbox;

        return view('pages.message', compact('id', 'avatar', 'members', 'outbox', 'recipients', 'inbox'));
      }
    }
    // end load all inbox & out box email



    public function lastCheckUpdate($mid)
    {
      $uid  = Auth::user()->id;
      EmailUser::where('emails_id', $mid)->where('users_id', $uid)->update(['last_checked_at' => Carbon::now()]);
      dd($mid."   ".$uid);
    }


    // start compose new mail
    public function send($id, Request $request)
    {
      //get sender details
      $uid  = Auth::user()->id;
      $user = User::getMailDetail($uid);

      // get all recipient ids
      $rids =  $request->receivers;

      //get subject & body of the mail
      $sub  = $request->subject;
      $body = $request->body;

      // create id for mail
      $mid  = Email::create(['teams_id' => $id]);

      $at   = Carbon::now();

      // save sender as one of the user for mail
      EmailUser::createMailUser($mid->id, $uid, $at);

      // send & save mail info for each recipient
      foreach ($rids as $rid)
      {
        //get email of recipient
        $to = User::find($rid)->email;

        //initialize mail variables
        $mail = new SendMail($user['email'], $user['detail']['firstname'], $user['detail']['lastname'], $sub, $body);

        //send mail
        \Mail::to($to)->send($mail);

        // register recipient as one of the user for mail
        EmailUser::createMailUser($mid->id, $rid, Carbon::today());
      }

      // save mail content
      EmailInfo::saveMail($mid->id, $uid, $sub, $body, $at);

      return redirect($id.'/messages');
    }
    // end compose new mail


    // start get all recipients of mail
    public function getEmails($mid)
    {
      $uid    = Auth::user()->id;
      $rusers = EmailUser::getRecipients($mid, $uid);
      return $rusers;
    }
    // end get all recipients of mail



    // start compose reply mail
    public function reply($id, Request $request)
    {
      $uid  = Auth::user()->id;
      $mid  = $request->mid;
      $sub  = $request->subject;
      $body = $request->body;


      //get sender details
      $user = User::getMailDetail($uid);

      // get recipients details
      $rusers = EmailUser::getRecipients($mid, $uid);

      foreach ($rusers as $ruser)
      {
        $to = $ruser->email;

        //initialize global variables
        $mail = new SendMail($user['email'], $user['detail']['firstname'], $user['detail']['lastname'], $sub, $body);

        //send mail
        \Mail::to($to)->send($mail);
      }

      // save mail content
      EmailInfo::saveMail($mid, $uid, $sub, $body, Carbon::now());

      return redirect($id.'/messages');
    }
    // end compose reply mail
}
