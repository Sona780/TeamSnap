<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Opponent extends Model
{
    //
    protected $fillable = [
         'name', 'team_id', 'contact_person', 'phone_no','email',
    ];
}
