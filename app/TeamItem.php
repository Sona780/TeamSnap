<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamItem extends Model
{
    //
    protected $fillable = [ 'teams_id','item_name' ];

    public $timestamps = false;

    public static function findItems($id)
    {
    	return static::where('teams_id', $id)
    				 ->select('id', 'item_name')
    				 ->get();
    }

    public static function updateItem($iid, $name)
    {
    	return static::find($iid)->update(['item_name' => $name]);
    }

    public static function findPlayerItemsDetail($tuid, $id)
    {
        return static::where('teams_id', $id)
                     ->get();
    }
}
