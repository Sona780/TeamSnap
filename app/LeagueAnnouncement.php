<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class LeagueAnnouncement extends Model
{
    //
    protected $fillable = [ 'league_id','title', 'announcement', 'start', 'end' ];

    public $timestamps  = false;
}
