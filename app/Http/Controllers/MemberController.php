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
use Auth;

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
            $owner = User::find($team->team_owner_id);
            $members = TeamUser::members($id)->get();
            $ctgs = TeamCtg::where('team_id', $id)->get();

            $member['player']['all'] = TeamUser::members($id)->where('flag', 1)->groupBy('users.id')->get();
            $member['non'] = TeamUser::members($id)->where('flag', 0)->groupBy('users.id')->get();
            $member['all']['all'] = TeamUser::members($id)->groupBy('users.id')->get();

            foreach ($ctgs as $ctg) {
              $member['player'][$ctg->id] = TeamUser::members($id)->where('team_ctgs_id', $ctg->id)->where('flag', 1)->get();
              $member['all'][$ctg->id] = TeamUser::members($id)->where('team_ctgs_id', $ctg->id)->get();
            }

            return view('pages.members',compact('id','ctgs','member'));
            //return $member['non'];
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
        $user->name = $request->firstname;
        $user->email = $request->email;
        $user->save();
        //end create new user

        //save new user details
        $members = new Userdetail(array(
              'firstname' => $request->get('firstname'),
              'lastname'  => $request->get('lastname'),
              'flag'      => $request->get('optradio'),
              'mobile'    => $request->get('mobile'),
              'role'      => $request->get('role'),
              'birthday'  => $request->get('birthday'),
              'city'      => $request->get('city'),
              'state'     => $request->get('state'),
              'user_id'   => $user->id,
              'avatar'    => $avatar,
        ));
        $members->save();
        //end save new user details

        //link member with team
        $team_users = new TeamUser(array(
              'team_id' => $id,
              'user_id' => $user->id,
        ));
        $team_users->save();
        //end link member with team

        //specify member categories
        $this->saveCat($user->id, $c);
        //end specify member categories

        return redirect($id.'/members');
    }
    //end save new member




    //fetch data of existing member
    public function get($id)
    {
      //$user_id = PlayerCtg::find($id)->user_id;
      $data = User::find($id);
      $data['details'] = UserDetail::where('user_id', $id)->first();
      $data['ctg'] = PlayerCtg::where('user_id', $id)->get();

      return $data;
    }
    //end fetch data of existing member




    //delete a member
    public function delete($id, $p_ctg)
    {
      User::find($id)->delete();
      return redirect($id.'/members');
    }
    //end delete a member





    //update existing member info
    public function update($id, Request $request)
    {
      //return $request->profile_img."     ".$request->file('file');

      //user id
      $uid = $request->id;

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
      Userdetail::where('user_id', $uid)->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'flag'      => $request->optradio,
            'mobile'    => $request->mobile,
            'role'      => $request->role,
            'birthday'  => $request->birthday,
            'city'      => $request->city,
            'state'     => $request->state,
            'avatar'    => $avatar,
        ]);
      //end update user details

      //update member categories
      PlayerCtg::where('user_id', $uid)->delete();
      $this->saveCat($uid, $c);
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
   public function saveCat($uid, $c)
   {
      foreach ($c as $cat)
      {
        $ctg = new PlayerCtg();
        $ctg->user_id = $uid;
        $ctg->team_ctgs_id = $cat;
        $ctg->save();
      }
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
}
