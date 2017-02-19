<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use TeamSnap\Media;
use DB;
use TeamSnap\Img;
use TeamSnap\File;
use TeamSnap\Team;

class MediaController extends Controller
{
    public function index($id)
    {
    	$teamid = Team::where('teamname',$id)->select('id')->get()->first();
      $videos = Media::where('team_id',$teamid->id)->get();
      $images = Img::where('team_id',$teamid->id)->get();
      $files  = File::where('team_id',$teamid->id)->get();
      return view('files',['id'=>$id,'videos'=>$videos,'images'=>$images,'files'=>$files]);
    }

  
  public function upload_url($id, Request $request)
   {
   	
    $url =new Media(array(
              'video_url'   => $request->get('videolink'),
              'video_title' => $request->get('videotitle'),
              'team_name'   => $id,
        ));
    $url->save();
    return redirect($id.'/files');
   	
   }

  public function img_store($id,Request $request)
    {
        $file =  $request->file('file');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move('images', $filename);
        $teamid = Team::where('teamname',$id)->select('id')->get()->first(); 
        //store img
        $images = new Img;
        $images-> img_name = $filename;
        $images-> team_id = $teamid->id; 
        $images->save();
        return $images;
    }
 
 public function file_store($id,Request $request)
    {
        $teamid = Team::where('teamname',$id)->select('id')->get()->first();
        $file =  $request->file('file');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move('files', $filename);
       
        //store file
        $files = new File;
        $files -> file_name = $filename;
        $files -> team_id = $teamid->id; 
        $files->save();
        return $files;
    }

}
