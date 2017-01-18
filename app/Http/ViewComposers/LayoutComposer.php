<<<<<<< HEAD
=======
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
    public $team_logo;

    public function __construct()
    {
          $user_id   = Auth::user()->id;
          $team_name = Team::where('id', $user_id)->select('teamname')->first();
          $user_name = User::where('id', $user_id)->select('name')->first();
          $team_logo = Team::where('teamname', $team_name->team_name)->select('team_logo')->first();

          $this->team_name = $team_name;
          $this->user_id   = $user_id;
          $this->user_name = $user_name;
          $this->team_logo = $team_logo;
    }

    public function compose(View $view)
    {
          $view->with('team_name',$this->team_name->teamname);
          $view->with('user_id',$this->user_id);
          $view->with('user_name',$this->user_name->name);
         // $view->with('team_logo',$this->team_logo->team_logo);
    }
}
>>>>>>> fabcc66372cb600b783cf5aeac548383b3796da5
