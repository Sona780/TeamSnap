<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class LeagueFile extends Model
{
    //
    protected $fillable = [ 'file_name', 'league_id' ];

    public $timestamps = false;

    public static function upload($lid, $file)
    {
        return static::create([ 'league_id'   => $lid, 'file_name'  => $file ]);
    }
}
