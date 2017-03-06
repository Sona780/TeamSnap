<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    protected $table = 'team_users';
    protected $fillable = [
        'team_id','user_id'
    ];


    public $timestamps = false;

}
