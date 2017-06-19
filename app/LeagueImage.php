<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class LeagueImage extends Model
{
    //
    protected $fillable = [ 'img_path', 'league_id' ];

    public $timestamps = false;

    public static function upload($lid, $img)
    {
        return static::create([ 'league_id' => $lid, 'img_path'  => $img, ]);
    }
}
