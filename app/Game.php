<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = [
         'user_id', 'team_id', 'date', 'hour', 'minute', 'time','opponent_id', 'results', 'location_id', 'uniform', 'duration_hour', 'duration_minute', 'place',
    ];
}
