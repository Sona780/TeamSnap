<?php

namespace Org4Leagues;

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

    public static function findPlayerFeesDetail($uid, $tid)
    {
        return static::where('teams_id', $tid)
                     ->leftJoin('player_fees', 'player_fees.team_fees_id', 'team_fees.id')
                     ->where('player_fees.team_users_id', $uid)
                     ->select('team_fees.description', 'team_fees.amount', 'player_fees.*')
                     ->get();
    }

    public static function findPlayerTotalFees($uid, $tid)
    {
        return static::where('teams_id', $tid)
                     ->leftJoin('player_fees', 'player_fees.team_fees_id', 'team_fees.id')
                     ->where('player_fees.team_users_id', $uid)
                     ->get()
                     ->sum('pamount');
    }
}
