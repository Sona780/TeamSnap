<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Ctg extends Model
{
    protected $table = 'ctgs';
    protected $fillable = [
         'name'.'team_id',
    ];
    

    public $timestamps = false;
    
    public function team()
    {
    	return $this-> belongsTo('TeamSnap\Team');
    }
}
