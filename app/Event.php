<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
         'users_id', 'teams_id', 'name', 'label', 'date', 'hour', 'minute', 'time','repeat','locations_id',
    ];
}
