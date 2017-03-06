<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
         'name', 'label', 'date', 'time','repeat','location_id',
    ];
}
