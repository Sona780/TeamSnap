<?php

namespace TeamSnap\Http\ViewComposer;

use Illuminate\View\View;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
use TeamSnap\AccessManage;
use TeamSnap\LeagueAccessManage;
use Auth;

class UserComposer
{
    public $manager_access;
    public $teams;
    public $maccess;
    public $teamleague;

    public function __construct($id, $ch)
    {
      if( !Auth::guest() )
      {
        $uid = Auth::user()->id;

        $this->teamleague = $ch;
        if( $ch == 'team' )
          $this->maccess = AccessManage::where('team_id', $id)->where('type', 1)->first();
        else
          $this->maccess = LeagueAccessManage::where('league_id', $id)->where('type', 1)->first();
        $this->manager_access = UserDetail::where('users_id', $uid)->first()->manager_access;
        $this->teams       = TeamUser::where('users_id', $uid)->leftJoin('teams', 'teams.id', 'team_users.teams_id')->select('teams.id', 'teams.teamname')->get();
      }
    }

    public function compose()
    {
      $manager_access = $this->manager_access;
      $teams = $this->teams;

      view()->composer('layouts.new', function ($view) use ($manager_access, $teams) {
          $view->with(['manager_access' => $manager_access, 'teams' => $teams, 'maccess' => $this->maccess, 'teamleague' => $this->teamleague]);
      });

      //$view->with(['user_detail' => $this->user_detail, 'teams' => $this->teams]);
    }
}

