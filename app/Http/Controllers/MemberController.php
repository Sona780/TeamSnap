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
use Auth;

use TeamSnap\Mail\SendMail;
use Mail;

class MemberController extends Controller
{
    //show existing members
    public function index($id)
    {
        $team = Team::find($id);
        if($team == NULL)
          return view('errors/404');
        else
        {
            // all categories for the team
            $ctgs = TeamCtg::getCtg($id);
            //return TeamUser::members($id)->get();
            // all players in the team
            $member['player']['all'] = TeamUser::members($id)->where('flag', 1)->groupBy('users.id')->get();
            // all non players in the team
            $member['non'] = TeamUser::members($id)->where('flag', 0)->groupBy('users.id')->get();
            // all members of the team
            $member['all']['all'] = TeamUser::members($id)->groupBy('users.id')->get();
            // sort members on the basis of category
            foreach ($ctgs as $ctg) {
              $member['player'][$ctg->id] = TeamUser::members($id)->where('player_ctgs.categories_id', $ctg->id)->where('flag', 1)->get();
              $member['all'][$ctg->id] = TeamUser::members($id)->where('player_ctgs.categories_id', $ctg->id)->get();
            }
            //get all the teams of current user
            $teams = Team::getUserTeams($id);
            return view('pages.members',compact('id','ctgs','member', 'teams'));
            //return $member['all']['all'];
        }
    }
   //end show existing members
   //save new member
   public function store($id, Request $request)
    {
        if( $request->file('file') == null )
          $avatar = config('paths.image_path').'4.jpg';
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
        //get selected categoeries of new member
        if( $request->categories == null )
          $c = [];
        else
          $c = $this->selectedCat($request->categories);
        //create new user
        $user = new User();
        $user->name       = $request->firstname;
        $user->email      = $request->email;
        $user->login_flag = 0;
        $user->save();
        //end create new user
        //save new user details
        UserDetail::newUser($user->id, $request, $avatar);
        //end save new user details
        //link member with team
        $tuser = TeamUser::createTeamUser($id, $user->id);
        //end link member with team
        // user team details
        TeamUserDetail::createNew($tuser->id, $request->optradio, $request->role);
        // end user team details
        //specify member categories
        $this->saveCat($tuser->id, $c);
        //end specify member categories

        // start save fee detail for member
        PlayerFee::saveNewPlayerFeeDetail($id, $tuser->id);
        // end save fee detail for member

        $teamd = Team::find($id);
        $userd = Auth::user();
        $email = new SendMail($userd->name, $userd->email, $teamd->teamname);
        Mail::to('singhdeopa@gmail.com')->send($email);

        return redirect($id.'/members');
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
        $avatar = config('paths.image_path').'4.jpg';
      //if the image is changed
      else if( $request->profile_img == 'changed' )
      {
        if( $request->file('file') == null )
          $avatar = config('paths.image_path').'4.jpg';
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
        $destinationPath1= config('paths.image_path');
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
}
