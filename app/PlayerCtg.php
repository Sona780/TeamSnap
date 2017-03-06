<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class PlayerCtg extends Model
{
    protected $table = 'player_ctgs';
    protected $fillable = [
         'team_id','user_id','team_ctgs_id',
    ];
    

    public $timestamps = false;

}
