<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

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

    //  start get all scheduled games for a team
        public static function getTeamGames($id)
        {
        	return static::where('games.teams_id', $id)
        				 ->where('games.results', '')
                         ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                         ->select('games.id', 'opponents.name')
        				 ->get();
        }
    //  end get all scheduled games for a team

    // start get games team has played
        public static function getTeamPlayedGames($id)
        {
            return static::where('games.teams_id', $id)
                         ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                         ->where('games.results', '!=', '')
                         ->select('games.id', 'opponents.name', 'games.results')
                         ->orderBy('date', 'desc')
                         ->get();
        }
    // end get games team has played

    // start get games in which player will play
        public static function PlayerFutureGames($tid, $uid)
        {
            return static::playerGames($tid, $uid)
                         ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                         ->where('games.results', '');
        }
    // end get games in which player will play

    // start get games in which player has played
        public static function PlayerPlayedGames($tid, $uid)
        {
            return static::playerGames($tid, $uid)->where('games.results', '!=', '');
        }
    // end get games in which player has played4

    // start get all player games for a team
        public static function getPlayerAllGames($tid, $uid)
        {
            return static::playerGames($tid, $uid)->latest('created_at')->get();
        }
    // end get all player games for a team

    // start get details of games played by a player
        public static function getPlayerGamesDetail($tid, $uid)
        {
            return static::playerGames($tid, $uid)
                         ->leftJoin('opponents', 'opponents.id', 'games.opponents_id')
                         ->where('games.results', '!=', '')
                         ->select('games.id', 'opponents.name', 'games.results')
                         ->orderBy('date', 'desc')
                         ->get();
        }
    // end get details of games played by a player

    // start function to select games in which a palyer plays
        public static function playerGames($tid, $uid)
        {
            return static::where('games.teams_id', $tid)
                         ->leftJoin('availabilities', 'availabilities.games_id', 'games.id')
                         ->where('availabilities.team_users_id', $uid);
        }
    // end function to select games in which a palyer plays
}
