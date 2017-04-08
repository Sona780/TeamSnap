<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Game extends Model
{
    //
    protected $fillable = [
         'users_id', 'teams_id', 'date', 'hour', 'minute', 'time','opponents_id', 'results', 'locations_id', 'uniform', 'duration_hour', 'duration_minute', 'place',
    ];

    public function baseballRecord()
    {
        return $this->hasMany('TeamSnap\BaseballRecord');
    }

    public function scopeFutureGames($query, $id)
    {
        $query->where('teams_id', $id)->where('results', '');
    }

    public function scopePlayedGames($query, $id)
    {
        $query->where('teams_id', $id)->where('results', '!=', '');
    }

    // get all scheduled games for a team
    public static function getTeamGames($id)
    {
    	return static::where('games.teams_id', $id)
    				 ->where('games.date', '>=', date('d/m/Y'))
                     ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                     ->select('games.id', 'opponents.name')
    				 ->get();
    }

    public static function getTeamPlayedGames($id)
    {
        return static::where('games.teams_id', $id)
                     ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                     ->select('games.id', 'opponents.name', 'games.results')
                     ->orderBy('date', 'desc')
                     ->get();
    }
}
