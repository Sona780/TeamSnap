<?php

namespace TeamSnap;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use TeamSnap\Userdetail;

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

    public function teams()
    {
        return $this -> hasMany('TeamSnap\Team');
    }

    //get sender user detail to send mail
    public static function getMailDetail($uid)
    {
        $user = collect([]);
        $user['email']  = User::find($uid)->email;
        $user['detail'] = Userdetail::where('users_id', $uid)->select('avatar', 'firstname', 'lastname')->first();
        return collect($user);
    }
}
