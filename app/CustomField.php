<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    //
    protected $fillable = [ 'team_id','field_name', 'field_type', 'field_options' ];

    public $timestamps  = false;
}
