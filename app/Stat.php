<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';
    protected $fillable = [
        'stats_name','acronym_name','formula','stats_group','team_id'
    ];


    public $timestamps = false;
}
