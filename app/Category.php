<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
         'category_name',
    ];

    public $timestamps = false;
}