<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = [
        'teams_id', 'detail', 'name','address', 'link', 'type'
    ];
}
