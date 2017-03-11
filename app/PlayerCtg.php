<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class PlayerCtg extends Model
{
    protected $table = 'player_ctgs';
    protected $fillable = [
         'team_users_id','categories_id',
    ];
    

    public $timestamps = false;


    //link a member to a ctegory
    public static function createNew($tuser, $cat)
    {
        return static::create([
                            'team_users_id' => $tuser,
        					'categories_id' => $cat,
                        ]);
    }

}
