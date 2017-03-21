<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Opponent extends Model
{
    //
    protected $fillable = [
         'name', 'teams_id', 'contact_person', 'phone_no','email',
    ];
}
