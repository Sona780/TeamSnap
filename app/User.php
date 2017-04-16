<?php

namespace TeamSnap;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TeamSnap\UserDetail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login_flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function leagues()
    {
        return $this->hasMany('TeamSnap\League');
    }

    public function teams()
    {
        return $this -> hasMany('TeamSnap\Team');
    }

    //get sender user detail to send mail
    public static function getMailDetail($uid)
    {
        $user = collect([]);
        $user['email']  = User::find($uid)->email;
        $user['detail'] = UserDetail::where('users_id', $uid)->select('avatar', 'firstname', 'lastname')->first();
        return collect($user);
    }

    public static function userData($uid)
    {
        return static::where('users.id', $uid)
                     ->leftJoin('user_details', 'user_details.users_id', 'users.id')
                     ->select('users.id', 'users.name', 'users.email', 'user_details.lastname')
                     ->first();
    }

    public static function getOwnerDetail($id)
    {
        return static::where('users.id', $id)
                     ->leftJoin('user_details', 'user_details.users_id', 'users.id')
                     ->select('users.id', 'users.email', 'user_details.firstname', 'user_details.lastname', 'user_details.avatar')
                     ->first();
    }
}
