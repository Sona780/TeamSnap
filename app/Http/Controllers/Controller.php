<?php

namespace TeamSnap\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use TeamSnap\User;
use TeamSnap\Team;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $url = \Request::url();
        $String = substr("$url",7);
        $teamname = explode('/', $String)[1];

        $team_logo = Team::where('teamname', $teamname)->select('team_logo')->get()->first();
        \View::share('team_name',$teamname);
        if($team_logo != '' ){
        \View::share('team_logo',$team_logo->team_logo);
        }
    }
}
