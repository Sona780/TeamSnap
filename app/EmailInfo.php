<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class EmailInfo extends Model
{
    //

    protected $fillable = ['emails_id', 'sender_id', 'body', 'subject', 'send_at'];


    public $timestamps = false;

    public static function saveMail($mid, $uid, $sub, $body, $at)
    {
        return static::create([ 'emails_id' => $mid,
                                'sender_id' => $uid,
                                'subject'   => $sub,
                                'body'      => $body,
                                'send_at'   => $at,
                             ]);
    }


    public static function outbox($uid, $tid)
    {
        return static::where('sender_id', $uid)
                     ->leftJoin('emails', 'emails.id', 'email_infos.emails_id')
                     ->where('emails.teams_id', $tid)
                     ->select('email_infos.*')
                     ->get();
    }

    public static function getDiffSendMails($uid)
    {
        return static::where('sender_id', $uid)->select('emails_id')->distinct()->get();
    }

    public static function getAllMails($mid)
    {
        return static::where('emails_id', $mid)
                     ->orderBy('send_at', 'asc')
                     ->get();
    }
}
