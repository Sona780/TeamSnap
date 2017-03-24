<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class TeamFee extends Model
{
    //
    protected $fillable = [ 'teams_id','description', 'amount', 'note' ];

    public $timestamps = false;

    public static function createNew($tid, $request)
    {
    	return static::create([
    			'teams_id'    => $tid,
    			'description' => $request->description,
    			'amount'      => $request->amount,
    			'note'        => $request->note,
    		]);
    }

    public static function updateDetails($fid, $desc, $amt, $note)
    {
        return static::find($fid)->update([
                'description' => $desc,
                'amount'      => $amt,
                'note'        => $note
            ]);
    }
}
