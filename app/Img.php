<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table = 'images';
    protected $fillable = [
         'img_name', 'teams_id'
    ];
    

    public $timestamps = false;

    public static function upload($tid, $img)
    {
        return static::create([
                            'teams_id'  => $tid,
                            'img_name'  => $img,
                        ]);
    }
}
