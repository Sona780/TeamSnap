<?php

namespace TeamSnap\Http\ViewComposers;

use Illuminate\View\View;
use DB;


class LayoutComposer 
{
    public $user_id;
    public $user_name;
    public $team_name;
    public function __construct()
    {
          $team_name=DB::table('teams')->select('teamname')->get();
          $user_id=DB::table('users')->select('id')->get();
          $user_name=DB::table('users')->select('name')->get();
          $this->team_name=$team_name;
          $this->user_id=$user_id;
          $this->user_name=$user_name;
    }

    public function compose(View $view)
    {
          $view->with('team_name',$this->team_name);
          $view->with('user_id',$this->user_id);
          $view->with('user_name',$this->user_name);
    }
}