<?php
namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use TeamSnap\User;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\TeamCtg;
use TeamSnap\Team;
use DB;
use TeamSnap\PlayerCtg;
use TeamSnap\TeamUserDetail;
use TeamSnap\PlayerFee;
use TeamSnap\AccessManage;
use Auth;

use TeamSnap\Mail\SendMail;
use Mail;

use TeamSnap\Http\ViewComposer\UserComposer;

class MemberController extends Controller
{
  //show existing members
    public function index($id)
    {
      $team   = Team::find($id);
      $uid    = Auth::user()->id;
      $user   = UserDetail::where('users_id', $uid)->first();
      $ch     = TeamUser::CheckMembership($id, $uid)->first();
      $access = AccessManage::getDetail($id);

      if($team == NULL || ($uid != $team->team_owner_id && $ch == '') || ($user->manager_access == 2 && $access->member == 0) )
        return view('errors/404');

      $composerWrapper = new UserComposer( $id, 'team' );
      $composerWrapper->compose();
      // all categories for the team
      $ctgs = TeamCtg::getCtg($id);
      // all players in the team
      $member['player']['all'] = TeamUser::getMembersByFlag($id, 1);
      // all non players in the team
      $member['non'] = TeamUser::getMembersByFlag($id, 0);
      // all members of the team
      $member['all']['all'] = TeamUser::members($id)->groupBy('users.id')->get();
      // sort members on the basis of category
      foreach ($ctgs as $ctg)
      {
        $member['player'][$ctg->id] = TeamUser::getMembersByCat($id, $ctg->id)->where('flag', 1)->get();
        $member['all'][$ctg->id]    = TeamUser::getMembersByCat($id, $ctg->id)->get();
      }
      //get all the teams of current user
      $teams = Team::getUserTeams($id);
      $team  = Team::find($id);

      return view('pages.members',compact('id','ctgs','member', 'teams', 'team', 'user'));
    }
  //end show existing members

  //save new member
    public function store($id, Request $request)
    {

      try
      {
        $teamd = Team::find($id);
        $userd = Auth::user();

        $email = new SendMail($userd->name, $userd->email, $teamd->teamname, $request->email);
        Mail::to($request->email)->send($email);

        if( $request->file('file') == null )
          $avatar = config('paths.default_avatar_path');
        else
        {
          //get image
          $image = $request->file('file');
          //resize & save image in server otherwise throw exception
          $avatar = $this->getImage($image);
        }

        //get selected categoeries of new member
        if( $request->categories == null )
          $c = [];
        else
          $c = $this->selectedCat($request->categories);

        $user = User::where('email', $request->email)->first();

        if( $user == '' )
        {
          //create new user
          $user = User::newUser($request->firstname, $request->email, 0);
          //save new user details
          UserDetail::newUser($user->id, $request, $avatar);
        }

        //link member with team
        $tuser = TeamUser::createTeamUser($id, $user->id);
        // user team details
        TeamUserDetail::createNew($tuser->id, $request->optradio, $request->role);
        //specify member categories
        $this->saveCat($tuser->id, $c);
        // start save fee detail for member
        PlayerFee::saveNewPlayerFeeDetail($id, $tuser->id);

        session()->flash('success', 'The member has been successfully added to the team.');
        return redirect($id.'/members');
      }
      catch(\Exception $e)
      {
        session()->flash('error', 'We are unable to process your request at the moment. Please try again later.');
        return redirect()->back();
      }
    }
  //end save new member

    //fetch data of existing member
    public function get($tuid)
    {
      //user id
      $uid = TeamUser::findUID($tuid);
      $data = User::find($uid);
      $data['details'] = UserDetail::where('users_id', $uid)->first();
      $data['team_details'] = TeamUserDetail::where('team_users_id', $tuid)->first();
      $data['ctg'] = PlayerCtg::where('team_users_id', $tuid)->get();
      return $data;
    }
    //end fetch data of existing member
    //delete a member
    public function delete($id, $tuid)
    {
      $uid = TeamUser::find($tuid)->users_id;
      User::find($uid)->delete();
      session()->flash('success', 'The member has been successfully deleted from the team.');
      return redirect($id.'/members');
    }
    //end delete a member
    //update existing member info
    public function update($id, Request $request)
    {
      //team_user id
      $tuid = $request->id;
      //user id
      $uid = TeamUser::findUID($tuid);
      //if the image is removed
      if( $request->profile_img == 'removed' )
        $avatar = config('paths.default_avatar_path');
      //if the image is changed
      else if( $request->profile_img == 'changed' )
      {
        if( $request->file('file') == null )
          $avatar = config('paths.default_avatar_path');
        else
        {
          //get image
          $image = $request->file('file');
          //resize & save image in server otherwise throw exception
          try{
              $avatar = $this->getImage($image);
          }catch(Exception $e){
              return redirect()->back()->withError('Could not resize Image');
          }
        }
      }
      //if the image is not changed
      else
        $avatar = $request->profile_img;
      //get selected categoeries of new member
      if( $request->categories == null )
        $c = [];
      else
        $c = $this->selectedCat($request->categories);
      //update user
      User::find($uid)->update([
            'name' => $request->firstname,
            'email' => $request->email,
        ]);
      //end update user
      //update user details
      UserDetail::updateDetail($uid, $request, $avatar);
      //end update user details
      //update team user details
      TeamUserDetail::updateDetail($tuid, $request->optradio, $request->role);
      //end update team user details
      //update member categories
      PlayerCtg::where('team_users_id', $tuid)->delete();
      $this->saveCat($tuid, $c);
      //end update member categories

      session()->flash('success', 'The member details has been updated successfully.');
      return redirect($id.'/members');
    }
    //end update existing member info
    //get selected categoeries of new member
   public function selectedCat($cats)
   {
      $c = [];
      $i = 0;
      foreach($cats as $cat)
        $c[$i++] = $cat;
      return $c;
   }
   //end get selected categoeries of new member
   //save memeber categories
   public function saveCat($tuser, $c)
   {
      foreach ($c as $cat)
        PlayerCtg::createNew($tuser, $cat);
   }
   //end save memeber categories
   //save image in server and return path of the image
   public function getImage($image)
    {
        $size=250; //set size for thumb
        $destinationPath1= config('paths.avatar_path');
        $public_html= config('paths.public_html');
        $str=str_random('4');
        $extension      =   $image->getClientOriginalExtension();
        $imageRealPath  =   $image->getRealPath();
        $substr         =   str_random('4');
        $thumbName      =   'thumb_'. $image->getClientOriginalName();
        $picName        =   'pic_'. $image->getClientOriginalName();
        $img = Image::make($imageRealPath); // use this if you want facade style code
        $img->save($public_html.$destinationPath1.$str.$picName);
        $d = $destinationPath1.$str.$picName;
        return $d;
    }
    //end save image in server and return path of the image
    //get the ctgs of team with id = tid
    public function getTeamCtgs($tid)
    {
      $ctgs = TeamCtg::getCtg($tid);
      return $ctgs;
    }
    //import the ctgs
    public function importCtg($id, Request $request)
    {
      $ctgs = $request->categories;
      foreach( $ctgs as $ctg )
      {
        $ch = TeamCtg::where('teams_id', $id)->where('categories_id', $ctg)->first();
        if( is_null($ch) )
        {
          $tctg = new TeamCtg();
          $tctg->teams_id = $id;
          $tctg->categories_id = $ctg;
          $tctg->save();
        }
      }
      return redirect($id.'/members');
    }
    //get the members of team with id = tid
    public function getTeamMembers($tid)
    {
      $members = TeamUser::getMembers($tid);
      return $members;
    }
    //import the members
    public function importMembers($id, Request $request)
    {
      $uids = $request->members;
      //return $members;
      foreach( $uids as $uid )
      {
        $ch = TeamUser::where('teams_id', $id)->where('users_id', $uid)->first();
        if( is_null($ch) )
        {
          $tuser = TeamUser::createTeamUser($id, $uid);
          TeamUserDetail::createNew($tuser->id, 0, '');
        }
      }
      return redirect($id.'/members');
    }

  // start check email availability
    public function valiMail($uid, Request $request)
    {
      $email = $request->email;
      $tid   = $request->teamid;
      $umail = ( $uid > 0 ) ? User::find(TeamUser::find($uid)->users_id)->email : $email;
      $ch    = 0;

      if( $uid == 0 || $umail != $email )
      {
        $user  = User::where('email', $email)->get()->first();
        if($user != '')
        {
          $tuser = TeamUser::checkIfManager($tid, $user->id);
          if( $tuser != '' )
            $ch = -1;
          else
            $ch = UserDetail::where('users_id', $user->id)->first()->manager_access;
        }
        //dd($tid."  ".$email);
      }
      return $ch;
    }
  // end check email availability
}
