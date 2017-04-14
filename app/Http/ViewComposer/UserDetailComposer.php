<?php

namespace TeamSnap\Http\ViewComposer;

use Illuminate\View\View;
use TeamSnap\UserDetail;
use TeamSnap\TeamUser;
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

