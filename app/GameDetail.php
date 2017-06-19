<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class GameDetail extends Model
{
    //
    protected $fillable = [ 'game_team_id','date', 'hour', 'minute', 'time', 'opponent_detail_id', 'result', 'location_detail_id', 'place', 'uniform', 'duration_hour', 'duration_minute' ];

    public $timestamps  = false;

    public static function getDetail($id)
    {
    	return static::where('game_team_id', $id)->first();
    }
}
