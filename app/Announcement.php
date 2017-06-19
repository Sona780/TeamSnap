<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $fillable = [ 'team_id', 'title', 'announcement', 'start', 'end' ];

    public $timestamps = false;
}
