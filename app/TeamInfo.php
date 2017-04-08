<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamInfo extends Model
{
    //
    protected $fillable = [ 'team_id','detail', 'uniform' ];

    public $timestamps = false;
}
