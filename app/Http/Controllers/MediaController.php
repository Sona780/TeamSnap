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
use Auth;
use TeamSnap\Http\ViewComposer\UserComposer;

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
        {
            return view('errors/404');
        }
        else
        {
            $videos = Media::where('teams_id', $id)->get();
            $images = Img::where('teams_id', $id)->get();
            $files  = File::where('teams_id', $id)->get();
            $team  = Team::find($id);
            return view('pages.media', compact('id', 'videos', 'images', 'files', 'mgr_access', 'team'));
        }
    }
    // end load media page
    //uploading and deleting video links
    // upload video
    public function uploadVideo($id, Request $request)
    {
        // save video title & URL
        Media::upload($id, $request);
        //redirect to media page
        return redirect($id.'/files');
    }
    // end upload video
    // delete a video
    public function deleteVideo($id, $vid)
    {
        Media::find($vid)->delete();
        //redirect to media page
        return redirect($id.'/files');
    }
    // end delete a video
    //end uploading and deleting video links

    // uploadig and deleting files
    // upload file
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
        File::upload($id, $fname);
        //redirect to media page
        return redirect($id.'/files');
    }
    // end upload file
    // delete a file
    public function deleteFile($id, $fid)
    {
        File::find($fid)->delete();
        //redirect to media page
        return redirect($id.'/files');
    }
    // end delete a file
    // end uploadig and deleting files
    // uploadig image functions
    // upload image
    public function uploadImg($id,Request $request)
    {
        //save image in server and get path
        $img = $this->getImage($request->file('image'));
        //update db
        Img::upload($id, $img);
        //redirect to media page
        return redirect($id.'/files');
    }
    // upload image
    //save image in server and return path of the image
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
    // end uploadig image functions
}
