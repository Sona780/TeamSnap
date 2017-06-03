<?php
namespace TeamSnap\Http\Controllers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use TeamSnap\Media;
use DB;
use TeamSnap\Img;
use TeamSnap\File;
use TeamSnap\Team;
use TeamSnap\TeamUser;
use TeamSnap\UserDetail;
use TeamSnap\AccessManage;

use TeamSnap\League;
use TeamSnap\DivisionManager;
use TeamSnap\LeagueDivision;
use TeamSnap\LeagueImage;
use TeamSnap\LeagueFile;
use TeamSnap\LeagueVideo;
use TeamSnap\LeagueTeam;

use Auth;
use TeamSnap\Http\ViewComposer\UserComposer;
use TeamSnap\Http\Controllers\DashboardController;

class MediaController extends Controller
{
  // load media page
    public function index($id)
    {
      $uid        = Auth::user()->id;
      $mgr_access = UserDetail::where('users_id', $uid)->first()->manager_access;
      $member     = TeamUser::where('users_id', $uid)->where('teams_id', $id)->first();
      $manager    = Team::CheckIfTeamOwner($uid, $id)->first();
      $access     = AccessManage::getDetail($id);

      $composerWrapper = new UserComposer( $id, 'team' );
      $composerWrapper->compose();

      if( $manager == '' && ($member == '' || ($member != '' && $mgr_access == 2 && $access->media == 0)) )
        return view('errors/404');

      $divs = LeagueTeam::teamDivs($id);
      foreach ($divs as $div)
      {
        $d = LeagueDivision::find($div->league_division_id);
        $league = League::find($d->league_id);
        $div->lname = $league->league_name;
        $div->imgs  = $league->images()->get();
        $div->vids  = $league->videos()->get();
        $div->file  = $league->files()->get();
      }
      //return $divs;

      $videos = Media::where('teams_id', $id)->get();
      $images = Img::where('teams_id', $id)->get();
      $files  = File::where('teams_id', $id)->get();
      $type   = 'team';
      $team   = Team::find($id);
      $arr    = ['team' => $id, 'active' => 'media', 'logo' => $team->team_logo, 'name' => $team->teamname, 'first' => $team->team_color_first];

      return view('pages.media', compact('id', 'videos', 'images', 'files', 'mgr_access', 'arr', 'type', 'divs'));
    }
  // end load media page

  // start media page for league
    public function leagueMedia($id, $ldid)
    {
      $owner = League::find($id)->user_id;
      $uid   = Auth::user()->id;
      $dman  = DivisionManager::check($uid, $ldid);

      if( $owner != $uid && $dman == 0 )
        return view('errors/404');

      $composerWrapper = new UserComposer( $id, 'league' );
      $composerWrapper->compose();

      $d    = new DashboardController();
      $prev = $d->path($ldid);
      $curr = LeagueDivision::find($ldid)->division_name;
      $arr  = ['team' => $id, 'active' => 'media', 'name' => $curr, 'ld' => $ldid];
      $type = 'league';

      $league = League::find($id);
      $videos = $league->videos()->get();
      $files  = $league->files()->get();
      $images = $league->images()->get();

      $mgr_access = 1;
      return view('pages.media', compact('id', 'videos', 'images', 'files', 'mgr_access', 'arr', 'prev', 'curr', 'type'));
    }
  // end media page for league

  // start upload video
    public function uploadVideo($id, Request $request)
    {
      // save video title & URL
      ($request->type == 'team') ? Media::upload($id, $request) : LeagueVideo::upload($id, $request);

      //redirect to media page with flash msgs
      session()->flash('active', 2);
      session()->flash('success', 'The video link uploaded successfully.');
      return redirect()->back();
    }
  // end upload video

  // start delete a video
    public function deleteVideo($id, $type, $vid)
    {
      ($type == 'team') ? Media::find($vid)->delete() : LeagueVideo::find($vid)->delete();

      //redirect to media page with flash msgs
      session()->flash('active', 2);
      session()->flash('success', 'The video link deleted successfully.');
      return redirect()->back();
    }
  // end delete a video

  // start upload file
    public function uploadFile($id, Request $request)
    {
      //get file name
      $file =  $request->file('file');
      //get path to folder in which file will be stored
      $path = config('paths.public_html').'/files/';
      //get name of the file
      $fname = $file->getClientOriginalName();
      // move the file to server
      $file->move($path, $fname);

      //save to db
      ( $request->type == 'team' ) ? File::upload($id, $fname) : LeagueFile::upload($id, $fname);

      //redirect to media page with flash msgs
      session()->flash('active', 2);
      session()->flash('success', 'The file has been uploaded successfully.');
      return redirect()->back();
    }
  // end upload file

  // start delete a file
    public function deleteFile($id, $type, $fid)
    {
      ($type == 'team') ? File::find($fid)->delete() : LeagueFile::find($fid)->delete();

      //redirect to media page with flash msgs
      session()->flash('active', 2);
      session()->flash('success', 'The file deleted successfully.');
      return redirect()->back();
    }
  // end delete a file

  // start upload image
    public function uploadImg($id,Request $request)
    {
      //save image in server and get path
      $img = $this->getImage($request->file('image'));
      //update db
      ( $request->type == 'team' ) ? Img::upload($id, $img) : LeagueImage::upload($id, $img);

      //redirect to media page with success message
      session()->flash('success', 'The image has been uploaded successfully.');
      return redirect()->back();
    }
  // end upload image

  // start save image in server and return path of the image
    public function getImage($image)
    {
      $size=250; //set size for thumb
      $destinationPath1= config('paths.gallery_path');
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
