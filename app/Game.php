<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = [
         'users_id', 'teams_id', 'date', 'hour', 'minute', 'time','opponents_id', 'results', 'locations_id', 'uniform', 'duration_hour', 'duration_minute', 'place',
    ];
}
