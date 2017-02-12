<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class PlayerCtg extends Model
{
    protected $table = 'player_ctgs';
    protected $fillable = [
         'playing','injured','topstar','team_name','member_id'
    ];
    

    public $timestamps = false;

}
