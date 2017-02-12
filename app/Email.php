<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    protected $fillable = [
         'title', 'body','sender_id','receiver_id',
         'mails'=>'array',
    ];
    

    public $timestamps = false;
}
