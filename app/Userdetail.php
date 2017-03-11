<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'users_id', 'firstname', 'lastname','flag', 'manager_access','mobile', 'gender', 'role','birthday','city','state','avatar',
    ];

    public $timestamps = false;

    public static function updateDetail($uid, $request, $avatar)
    {
    	return static::where('users_id', $uid)->update([
				            'firstname' => $request->firstname,
				            'lastname'  => $request->lastname,
				            'mobile'    => $request->mobile,
				            'birthday'  => $request->birthday,
				            'city'      => $request->city,
				            'state'     => $request->state,
				            'gender'     => $request->gender,
				            'avatar'    => $avatar,
				        ]);
    }

    public static function newUser($uid, $request, $avatar)
    {
    	return static::create([
    						'users_id'  => $uid,
				            'firstname' => $request->firstname,
				            'lastname'  => $request->lastname,
				            'mobile'    => $request->mobile,
				            'birthday'  => $request->birthday,
				            'city'      => $request->city,
				            'state'     => $request->state,
				            'gender'     => $request->gender,
				            'avatar'    => $avatar,
				        ]);
    }
}
