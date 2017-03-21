<?php
namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Image;
use TeamSnap\Team;
use TeamSnap\PlayerCtg;


class ProfileController extends Controller
{
    public function index($id)
    {
      $avatar = Member::where('id',$id)->select('avatar')->get()->first();
    	$members = Member::where('id',$id)->get();
      $vid = Member::where('id',$id)->select('id')->get()->first();
       $avatar = Member::where('id',$id)->select('avatar')->get()->first();
      return view('profile', [ 'teamname' => $id, 'avatar' => $avatar, 'id' => $vid, 'avatar' => $avatar ]);
    }

    public function update_avatar($id,Request $request)
    {
        

       if($request->hasFile('avatar'))
       {

       	   $avatars = $request->file('avatar');
       	   $filename = time().'.'.$avatars->getClientOriginalExtension();
       	   Image::make($avatars)->resize(300,300)->save(public_path('/uploads/avatars/'. $filename));
           $avatar = Member::where('id',$id)->select('avatar')->get()->first();
           $avatar->avatar=$filename;
           $avatar->save();
           Member::where('id',$id)->update(['avatar' => $avatar->avatar]);
          
       }
       return redirect($id.'/profile');
    }

    /*public function edit($id)
    {
      $article = Member::findorFail($id);
      $mid=$article->id;
      return view('edit', [ 'teamname' => $id, 'article' => $article, 'mid' => $mid ]);
    }*/

    /*public function update($id, Request $request)
    {
       $members = Member::findorFail($id);
       $members->update($request->all());
       
       //ctgs
       $team = Member::where('id',$id)->select('team_name')->get()->first();
       $teamname= $team->team_name;
       $ctgs = new PlayerCtg;
       $ctgs->playing   = $request->get('playing');
       $ctgs->injured   = $request->get('injured');
       $ctgs->topstar   = $request->get('topstar');
       $ctgs->team_name = $teamname;
       $ctgs->member_id   =  $id; 
       $ctgs->save(); 
       return $ctgs;

    }*/

    /*public function delete($id)
    {

       $teamname = Member::where('id', $id)->select('team_name')->get()->first();
       Member::where('id', '=', $id)->delete();
       return redirect($teamname->team_name.'/members') ;
    }*/

}
