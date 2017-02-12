<?php

namespace TeamSnap;
use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
    protected $table = 'medias';
    protected $fillable = [
         'video_url', 'video_title','team_name'
    ];
    

    public $timestamps = false;

    public function user()
    {
    	return $this-> belongsTo('TeamSnap\User');
    }
}
