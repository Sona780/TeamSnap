<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class TeamCtg extends Model
{
    protected $table = 'team_ctgs';
    protected $fillable = [
         'teams_id','categories_id',
    ];


    public $timestamps = false;

    public static function getCtg($id)
    {
    	return static::leftJoin('categories', 'team_ctgs.categories_id', '=', 'categories.id')
    				 ->select('categories.id', 'team_ctgs.teams_id', 'categories.category_name')
    				 ->where('team_ctgs.teams_id', $id)
                     ->orderBy('categories.id')
                     ->get();
    }
}
