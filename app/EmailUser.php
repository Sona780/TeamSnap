<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class EmailUser extends Model
{
    //

    protected $fillable = ['users_id', 'emails_id', 'last_checked_at'];


    public $timestamps = false;


    public static function createMailUser($mid, $uid, $at)
    {
        return static::create(['users_id' => $uid, 'emails_id' => $mid, 'last_checked_at' => $at]);
    }

    public static function getRecipients($mid, $uid)
    {
        return static::where('email_users.emails_id', $mid)
                     ->where('email_users.users_id', '!=', $uid)
                     ->leftJoin('users', 'users.id', 'email_users.users_id')
                     ->leftJoin('user_details', 'users.id', 'user_details.users_id')
                     ->select('users.email', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar', 'email_users.*')
                     ->get();
    }


    public static function getMailUsers($mid)
    {
        return static::where('email_users.emails_id', $mid)
                     ->leftJoin('users', 'users.id', 'email_users.users_id')
                     ->leftJoin('user_details', 'users.id', 'user_details.users_id')
                     ->select('users.email', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar', 'email_users.*')
                     ->get();
    }

}
