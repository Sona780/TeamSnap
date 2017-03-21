<?php

namespace TeamSnap;
use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    protected $fillable = [
         'video_url', 'video_title','teams_id'
    ];

    public function user()
    {
    	return $this-> belongsTo('TeamSnap\User');
    }


    // upload the video link
    public static function upload($tid, $request)
    {
        return static::create([
                            'teams_id'  => $tid,
                            'video_title'  => $request->title,
                            'video_url'  => $request->url,
                        ]);
    }
}
