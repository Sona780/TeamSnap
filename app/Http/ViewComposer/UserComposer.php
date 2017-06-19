<?php

namespace Org4Leagues\Http\ViewComposer;

use Illuminate\View\View;
use Org4Leagues\UserDetail;
use Org4Leagues\TeamUser;
use Org4Leagues\AccessManage;
use Org4Leagues\LeagueAccessManage;
use Auth;

class UserComposer
{
    public $manager_access;
    public $teams;
    public $maccess;
    public $type;
    public $leagues;

    public function __construct($id, $ch)
    {
      if( !Auth::guest() )
      {
        $uid = session('id') ? session('id') : Auth::user()->id;
        $this->type = $ch;

        if( $ch == 'team' )
          $this->maccess = AccessManage::ManagerAccess($id)->first();
        else
          $this->maccess = LeagueAccessManage::where('league_id', $id)->where('type', 1)->first();

        $this->manager_access = UserDetail::where('users_id', $uid)->first()->manager_access;
      }
    }

    public function compose()
    {
      $access  = $this->manager_access;
      $teams   = $this->teams;
      $maccess = $this->maccess;
      $type    = $this->type;

      view()->composer('layouts.new', function ($view) use ($access, $teams, $maccess, $type) {
          $view->with(['manager_access' => $access, 'maccess' => $maccess, 'teamleague' => $type]);
      });
    }
}

