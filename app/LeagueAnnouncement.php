<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueAnnouncement extends Model
{
    //
    protected $fillable = [ 'league_id','title', 'announcement' ];

    public $timestamps  = false;
}
