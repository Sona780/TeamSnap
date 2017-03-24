<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use TeamSnap\TeamUser;
use TeamSnap\PlayerFee;
use TeamSnap\TeamFee;

class PlayerFee extends Model
{
    //
    protected $fillable = [ 'team_users_id','team_fees_id', 'pamount', 'status', 'transaction_note' ];

    public $timestamps  = false;


    // start save fee detail for each member when new team fee is created
	    public static function createNew($tid, $fee)
	    {
	    	$members = TeamUser::where('teams_id', $tid)->select('id')->get();

	    	foreach ($members as $member)
	    		PlayerFee::saveFeeDetail($member->id, $fee);
	    }
    // end save fee detail for each member when new team fee is created


	// start save fee detail for newly created member
	    public static function saveNewPlayerFeeDetail($tid, $tuid)
	    {
	    	$fees = TeamFee::where('teams_id', $tid)->select('id', 'amount')->get();
	    	foreach ($fees as $fee)
	    		PlayerFee::saveFeeDetail($tuid, $fee);
	    }
    // end save fee detail for newly created member


    // start save fee detail for member
	    public static function saveFeeDetail($tuid, $fee)
	    {
	    	PlayerFee::create([
	    				'team_users_id'     => $tuid,
	    				'team_fees_id'      => $fee->id,
	    				'pamount'           => $fee->amount,
	    				'status'            => 1,
	    				'transaction_note'  => '',
	    			]);
	    }
    // end save fee detail for member


	// start deatil of all items in a team
		public static function findAllFeeDetails($tuid)
		{
			return static::where('team_users_id', $tuid)
						 ->orderBy('team_fees_id', 'asc')
						 ->get();
		}
	// end deatil of all items in a team

	public static function updateToPaid($uid, $fid, $note)
	{
		return static::where('team_users_id', $uid)
					 ->where('team_fees_id', $fid)
					 ->update([
					 		'pamount'           => 0,
					 		'status'            => 0,
					 		'transaction_note'  => $note,
					 	]);
	}

	public static function updateFeeChange($uid, $fid, $amt, $note)
	{
		return static::where('team_users_id', $uid)
					 ->where('team_fees_id', $fid)
					 ->update([
					 		'pamount'           => $amt,
					 		'status'            => 1,
					 		'transaction_note'  => $note,
					 	]);
	}


	public static function updateNotApply($uid, $fid, $note)
	{
		return static::where('team_users_id', $uid)
					 ->where('team_fees_id', $fid)
					 ->update([
					 		'pamount'           => 0,
					 		'status'            => 2,
					 		'transaction_note'  => $note,
					 	]);
	}


	public static function findTotalBalance($uid)
	{
		return static::where('team_users_id', $uid)
					 ->get()
					 ->sum('pamount');
	}

	public static function getFeeTotal($fid)
	{
		return static::where('team_fees_id', $fid)
					 ->get()
					 ->sum('pamount');
	}

	public static function updateAmount($fid, $amt)
	{
		$members = PlayerFee::where('team_fees_id', $fid)->where('status', '!=', 2)->get();

		foreach ($members as $member)
		{
			$new = $amt + floatval($member->pamount);
			PlayerFee::find($member->id)->update([
					'pamount' => $new,
					'status'  => 1
				]);
		}
	}
}
