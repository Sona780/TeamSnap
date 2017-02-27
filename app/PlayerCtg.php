<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class PlayerCtg extends Model
{
    protected $table = 'player_ctgs';
    protected $fillable = [
         'team_id','user_id','ctg_id',
    ];
    

    public $timestamps = false;

}
