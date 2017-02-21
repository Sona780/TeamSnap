<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamCtg extends Model
{
    protected $table = 'team_ctgs';
    protected $fillable = [
         'team_id','ctg_id',
    ];
    

    public $timestamps = false;
}
