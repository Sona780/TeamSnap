<?php
namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use TeamSnap\Member;
use Image;
use TeamSnap\Team;


class ProfileController extends Controller
{
    public function index($id)
    {
    	$avatar = Member::where('id',$id)->select('avatar')->get()->first();
    	$members = Member::where('id',$id)->get();
      $vid = Member::where('id',$id)->select('id')->get()->first();
      return view('profile', [ 'teamname' => $id, 'avatar' => $avatar, 'id' => $vid ]);
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

       return view('profile',compact('avatar','members'));
    }

    public function edit($id)
    {
      $article = Member::findorFail($id);
      $mid=$article->id;
      return view('edit', [ 'teamname' => $id, 'article' => $article, 'mid' => $mid ]);
    }

    public function update($id, Request $request)
    {

        $data=$request->get('playertype');
        if($data == 1)
          {
            $flag1=true;
          }
        else
          {
            $flag1 = false;
          }
       $article = Member::findorFail($id);
       $article->flag=$flag1;
       $article->update($request->all());
       return redirect($article->team_name.'/members');

    }

    public function delete($id)
    {

       $teamname = Member::where('id', $id)->select('team_name')->get()->first();
       Member::where('id', '=', $id)->delete();
       return redirect($teamname->team_name.'/members') ;
    }

}
