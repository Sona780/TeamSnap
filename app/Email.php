<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Email extends Model
{
    protected $table = 'emails';

    protected $fillable = ['teams_id'];

    public $timestamps = false;


    public static function getUserMails($uid, $tid)
    {
        return static::where('teams_id', $tid)
                     ->leftJoin('email_users', 'email_users.emails_id', 'emails.id')
                     ->where('email_users.users_id', $uid)
                     ->select('email_users.emails_id', 'email_users.last_checked_at')
                     ->distinct()->get();
    }


    // save mail details
    public static function send($uid, $sub, $body, $to, $eid)
    {
        return static::create([
                            'users_id'  	=> $uid,
                            'title'  		=> $sub,
                            'body'  		=> $body,
                            'receivers_id'  => $to,
                            'reply_id'	    => $eid,
                            'send_at'       => Carbon::now(),
                            'last_reply_at' => Carbon::now(),
                        ]);
    }


    // get all emails send by user
    public static function outbox($uid)
    {
    	return static::where('emails.users_id', $uid)
    				 ->leftJoin('user_details', 'user_details.users_id', '=', 'emails.receivers_id')
    				 ->leftJoin('users', 'users.id', '=', 'emails.receivers_id')
                     ->select('users.name', 'users.email', 'user_details.lastname', 'emails.*')
                     ->get();
    }



    // get all outbox emails not reply of other mails for user
    public static function getPrimaryOutbox($uid)
    {
        return static::where('emails.users_id', $uid)
                     ->where('emails.receivers_id', '!=', $uid)
                     ->where('emails.reply_id', 0)
                     ->leftJoin('user_details', 'user_details.users_id', '=', 'emails.receivers_id')
                     ->leftJoin('users', 'users.id', '=', 'emails.receivers_id')
                     ->select('users.name', 'users.email', 'user_details.avatar', 'user_details.lastname', 'emails.*');
    }



    // get all inbox emails not reply of other mails for user
    public static function getPrimaryInbox($uid)
    {
        return static::where('emails.receivers_id', $uid)
                     ->where('emails.reply_id', 0)
                     ->leftJoin('user_details', 'user_details.users_id', '=', 'emails.users_id')
                     ->leftJoin('users', 'users.id', '=', 'emails.users_id')
                     ->select('users.name', 'users.email', 'user_details.avatar', 'user_details.lastname', 'emails.*');
    }


    // all conversation in inbox
    public static function getAllInbox($uid)
    {
        return static::getPrimaryInbox($uid)
                     ->union(static::getPrimaryOutbox($uid))
                     ->orderBy('send_at', 'desc')
                     ->get();
    }


    // get all reply of a mail
    public static function getReplies($eid)
    {
        return static::where('emails.reply_id', $eid)
                     ->leftJoin('user_details', 'user_details.users_id', '=', 'emails.users_id')
                     ->leftJoin('users', 'users.id', '=', 'emails.users_id')
                     ->select('users.name', 'users.email', 'user_details.avatar', 'user_details.lastname', 'emails.*');
    }
}
