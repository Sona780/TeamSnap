<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Team extends Model
{
    protected $fillable = [
    'teamname', 'all_games_id','country','zip','user_id','team_logo','team_owner_id','team_color_first','team_color_second'
    ];


    public $timestamps = false;


    public function user()
    {
    	return $this-> belongsTo('Org4Leagues\User');
    }

    public function info()
    {
        return $this->hasOne('Org4Leagues\TeamInfo');
    }

    public function prefs()
    {
        return $this->hasOne('Org4Leagues\SitePref');
    }

    public function ctgs()
    {
    	return $this -> hasMany('Org4Leagues\Ctg');
    }

    public function fields()
    {
        return $this->hasMany('Org4Leagues\CustomField');
    }

    public function scopeCheckIfTeamOwner($query, $uid, $id)
    {
        $query->where('team_owner_id', $uid)->where('id', $id);
    }


    public static function getUserTeams($id)
    {
        return static::where('team_owner_id', Auth::user()->id)
                     ->where('id','!=', $id)
                     ->select('id', 'teamname')
                     ->get();
    }

    public static function newTeam($name, $game)
    {
        return static::create(['teamname' => $name, 'all_games_id' => $game]);
    }

    public static function newLeagueTeam($tname, $uid, $game)
    {
        return static::create([ 'teamname' => $tname, 'all_games_id' => $game, 'team_owner_id' => $uid ]);;
    }

    public static function getDetail($id)
    {
        return static::select('id', 'teamname')->find($id);
    }
}
