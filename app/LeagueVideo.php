<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class LeagueVideo extends Model
{
    //
    protected $fillable = [ 'video_url', 'video_title','league_id' ];

    public $timestamps  = false;

    // upload the video link
    public static function upload($lid, $request)
    {
        return static::create([ 'league_id'  => $lid, 'video_title'  => $request->title, 'video_url'  => $request->url ]);
    }
}
