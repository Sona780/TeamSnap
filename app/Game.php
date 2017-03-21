<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = [
         'users_id', 'teams_id', 'date', 'hour', 'minute', 'time','opponents_id', 'results', 'locations_id', 'uniform', 'duration_hour', 'duration_minute', 'place',
    ];

    // get all scheduled games for a team
    public static function getTeamGames($id)
    {
    	return static::where('games.teams_id', $id)
    				 ->where('games.date', '>=', date('d/m/Y'))
                     ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                     ->select('games.id', 'opponents.name')
    				 ->get();
    }
}
