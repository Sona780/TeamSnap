<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;

use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\PlayerFee;
use TeamSnap\TeamItem;
use TeamSnap\TeamFee;
use TeamSnap\Team;
use TeamSnap\Asset;
use TeamSnap\PlayerItemTrack;
use Auth;

use TeamSnap\Http\ViewComposer\UserComposer;

class AssetsController extends Controller
{
    // start show team fee & item details
        public function show($id)
        {

            $uid     = Auth::user()->id;
            $user    = UserDetail::where('users_id', $uid)->first();
            $member  = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
            $owner   = Team::CheckIfTeamOwner($uid, $id)->first();
            $manager = ( $user->manager_access == 2 ) ? TeamUser::where('teams_id', $id)->where('users_id', $uid)->first() : '';

            $composerWrapper = new UserComposer( $id, 'team' );
            $composerWrapper->compose();

            if( $owner != '' || $manager != '' )
            {
                $total   = 0;

                // fimd all team fees for given team
                $fees    = TeamFee::where('teams_id', $id)->orderBy('id', 'asc')->get();

                // start find total sum of all different team fee
                foreach ($fees as $fee)
                    $fee->total = PlayerFee::getFeeTotal($fee->id);
                // end find total sum of all different team fee

                // find all the players members of the team
                $players = TeamUser::getTeamPlayers($id, 1);

                // start fimd fee details of all team fee & total balance for all the players
                foreach ($players as $player)
                {
                    $player['fees']  = PlayerFee::findAllFeeDetails($player->id);
                    $player['total'] = PlayerFee::findTotalBalance($player->id);
                    $total = $total + $player['total'];
                }
                // end fimd fee details of all team fee & total balance for all the players

                // find all the non players members of the team
                $staffs = TeamUser::getTeamPlayers($id, 0);

                // start fimd fee details of all team fee & total balance for all the non players
                foreach ($staffs as $staff)
                {
                    $staff['fees'] = PlayerFee::findAllFeeDetails($staff->id);
                    $staff['total'] = PlayerFee::findTotalBalance($staff->id);
                    $total = $total + $staff['total'];
                }
                // start fimd fee details of all team fee & total balance for all the non players

                $items = TeamItem::findItems($id);
                //return $items;

                foreach ($items as $item)
                {
                    $item->count = PlayerItemTrack::where('team_items_id', $item->id)->get()->count();
                }

                $pitems = [];

                foreach ($players as $player)
                {
                    $pid = $player->id;
                    $iid = PlayerItemTrack::getItems($pid);

                    foreach ($iid as $i)
                        $pitems[$pid][$i->team_items_id] = 'yes';
                }

                foreach ($staffs as $staff)
                {
                    $pid = $staff->id;
                    $iid = PlayerItemTrack::getItems($pid);

                    foreach ($iid as $i)
                        $pitems[$pid][$i->team_items_id] = 'yes';
                }

                $team  = Team::find($id);

                return view('pages.assets', compact('id', 'fees', 'players', 'staffs', 'total', 'items', 'pitems', 'team'));
            }
            else if( $member != '' )
            {
                $playerfees  = TeamFee::findPlayerFeesDetail($member->id, $id);
                $totalfees   = TeamFee::findPlayerTotalFees($member->id, $id);
                $teamitems   = TeamItem::findPlayerItemsDetail($member->id, $id);
                $iavailable  = 0;

                foreach ($teamitems as $item)
                {
                    $ch = PlayerItemTrack::checkPlayerItem($member->id, $item->id);
                    $item->check = 0;
                    if( $ch != '' )
                    {
                        $item->check = 1;
                        $iavailable++;
                    }
                }

                $team  = Team::find($id);

                return view('members.assets', compact('id', 'playerfees', 'teamitems', 'totalfees', 'iavailable', 'team'));
            }
            else
                return view('errors/404');
        }
    // end show team fee & item details

    // start save new team fee
        public function saveTeamFee($id, Request $request)
        {
        	$tfee = TeamFee::createNew($id, $request);
            PlayerFee::createNew($id, $tfee);
            return redirect($id.'/assets');
        }
    // end save new team fee

    // start get fee details
        public function getFeeDetail($fid)
        {
            $fee = TeamFee::find($fid);
            return $fee;
        }
    // end get fee details

    // start update member status to paid
        public function updateToPaid(Request $request)
        {
            PlayerFee::updateToPaid($request->uid, $request->fid, $request->note);
        }
    // end update member status to paid

    // start save change in fee detail
        public function updateFeeChange(Request $request)
        {
            PlayerFee::updateFeeChange($request->uid, $request->fid, $request->amt, $request->note);
        }
    // end save change in fee detail

    // start update member status to not apply
        public function updateNotApply(Request $request)
        {
            PlayerFee::updateNotApply($request->uid, $request->fid, $request->note);
        }
    // end update member status to not apply

    // start save new item
        public function saveItem($id, Request $request)
        {
            TeamItem::create([
                    'teams_id'  => $id,
                    'item_name' => $request->name,
                ]);
            return redirect($id.'/assets');
        }
    // end save new item

    // start change member item tracking status
        public function updateItemTracking(Request $request)
        {
            $tuid = $request->tuid;
            $iid  = $request->iid;

            if( $request->ch == 1 )
                PlayerItemTrack::createNew($tuid, $iid);
            else
                PlayerItemTrack::deletePlayerItem($tuid, $iid);
        }
    // start change member item tracking status

    // start update item info
        public function updateItem($id, $iid, $name)
        {
            TeamItem::updateItem($iid, $name);
            return redirect($id.'/assets');
        }
    // start update item info

    // start delete item
        public function deleteItem($id, $iid)
        {
            TeamItem::find($iid)->delete();
            return redirect($id.'/assets');
        }
    // end delete item

    // start update fee info
        public function updateFee($id, Request $request)
        {
            $fid  = $request->fee_id;
            $pamt = TeamFee::find($fid)->amount;
            $camt = $request->amount;
            $diff = floatval($camt) - $pamt;

            TeamFee::updateDetails($fid, $request->description, $camt, $request->note);

            if( $diff != 0 )
                PlayerFee::updateAmount($fid, $diff);

            return redirect($id.'/assets');
        }
    // end update fee info

    // start delete fee
        public function deleteFee($id, $fid)
        {
            TeamFee::find($fid)->delete();
            return redirect($id.'/assets');
        }
    // end delete fee
}
