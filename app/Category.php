<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
         'category_name',
    ];

    public $timestamps = false;
}
