<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamUserDetail extends Model
{
    //
    protected $fillable = [
        'team_users_id', 'flag', 'role'
    ];

    public $timestamps = false;

    public static function createNew($tuid, $flag, $role)
    {
        return static::create([
                            'team_users_id'  => $tuid,
                            'flag'  => $flag,
                            'role'  => $role,
                        ]);
    }

    public static function updateDetail($tuid, $flag, $role)
    {
        return static::where('team_users_id', $tuid)->update([
                            'flag'  => $flag,
                            'role'  => $role,
                        ]);
    }
}
