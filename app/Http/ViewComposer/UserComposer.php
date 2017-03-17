<?php

namespace TeamSnap\Http\ViewComposer;

use Illuminate\View\View;
use \TeamSnap\Userdetail;
use \TeamSnap\TeamUser;
use Auth;

class UserComposer
{
    public $user_detail;
    public $teams;

    public function __construct()
    {
      if( !Auth::guest() )
      {
        $uid = Auth::user()->id;

        $this->user_detail = Userdetail::where('users_id', $uid)->first();
        $this->teams       = TeamUser::where('users_id', $uid)->leftJoin('teams', 'teams.id', 'team_users.teams_id')->select('teams.id', 'teams.teamname')->get();
      }
    }

    public function compose(View $view)
    {
      $view->with(['user_detail' => $this->user_detail, 'teams' => $this->teams]);
    }
}

