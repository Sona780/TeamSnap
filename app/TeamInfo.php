<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class TeamInfo extends Model
{
    //
    protected $fillable = [ 'team_id','detail', 'uniform', 'alernate_sport_name', 'league', 'league_url', 'division', 'season', 'level', 'age_group', 'gender', 'home_uniform', 'away_uniform', 'time_zone_id', 'custom_domain' ];

    public $timestamps = false;
}
