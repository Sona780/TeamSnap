<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class BaseballRecord extends Model
{
    //

    protected $fillable = [
         'team_user_id', 'game_id','at_bats','runs', 'hits', 'doubles','triples','home_runs', 'runs_batted_in', 'bases_on_balls','strike_outs','stolen_bases', 'caught_stealing', 'hit_by_pitch', 'sacrifice_flies', 'singles'
    ];


    public $timestamps = false;
}
