<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class PublicUrl extends Model
{
    //
    protected $fillable = [ 'team_id', 'team_url', 'status' ];

    public $timestamps  = false;
}
