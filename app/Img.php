<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table = 'images';
    protected $fillable = [
         'img_name', 'team_name'
    ];
    

    public $timestamps = false;
}
