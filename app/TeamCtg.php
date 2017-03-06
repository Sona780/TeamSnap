<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamCtg extends Model
{
    protected $table = 'team_ctgs';
    protected $fillable = [
         'team_id','name',
    ];


    public $timestamps = false;
}
