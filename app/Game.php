<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //
    protected $fillable = [
         'date', 'time','opponent','location','location_detail',
    ];
}
