<?php

namespace TeamSnap;
use Illuminate\Database\Eloquent\Model;


class Media extends Model
{
     protected $fillable = [
         'video_url', 'video_title','team_id'
    ];
    
    public $timestamps = false;

    public function user()
    {
    	return $this-> belongsTo('TeamSnap\User');
    }
}
