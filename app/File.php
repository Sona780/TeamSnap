<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    
    protected $table = 'files';
    protected $fillable = [
         'file_name', 'team_name'
    ];
    

    public $timestamps = false;

}
