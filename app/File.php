<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    
    protected $table = 'files';
    protected $fillable = [
         'file_name', 'teams_id'
    ];
    

    public $timestamps = false;

    public static function upload($tid, $file)
    {
        return static::create([
                            'teams_id'   => $tid,
                            'file_name'  => $file,
                        ]);
    }

}
