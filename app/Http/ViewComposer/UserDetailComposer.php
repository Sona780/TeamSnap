<?php

namespace Org4Leagues\Http\ViewComposer;

use Illuminate\View\View;
use Org4Leagues\UserDetail;
use Org4Leagues\TeamUser;
use Auth;

class UserDetailComposer
{
    public $user_detail;

    public function __construct()
    {
      if( !Auth::guest() )
      {
        $uid = Auth::user()->id;

        $this->user_detail = UserDetail::where('users_id', $uid)->first();
      }
    }

    public function compose(View $view)
    {
      $view->with(['user_detail' => $this->user_detail]);
    }
}

