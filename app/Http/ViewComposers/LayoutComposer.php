<?php

namespace TeamSnap\Http\ViewComposers;

use Illuminate\View\View;
use DB;
use \TeamSnap\Team;
use \TeamSnap\Member;
use \TeamSnap\User;
use Auth;

class LayoutComposer
{
    public $user_id;
    public $user_name;
    public $team_name;

    public function __construct()
    {
          $user_id = Auth::user()->id;;
          $team_name = Member::where('user_id', $user_id)->select('team_name')->first();
          $user_name = User::where('id', $user_id)->select('name')->first();

          $this->team_name = $team_name;
          $this->user_id = $user_id;
          $this->user_name = $user_name;
    }

    public function compose(View $view)
    {
          $view->with('team_name',$this->team_name->team_name);
          $view->with('user_id',$this->user_id);
          $view->with('user_name',$this->user_name->name);
    }
}
