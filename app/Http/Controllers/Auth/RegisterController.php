<?php

namespace TeamSnap\Http\Controllers\Auth;

use TeamSnap\User;
use TeamSnap\Userdetail;
use TeamSnap\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:20',
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $ch   = User::where('email', $data['email']);

        if( $ch->get()->count() == 0 )
        {
            $user = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'  => bcrypt($data['password']),
                'login_flag'=> 1,
            ]);

            Userdetail::create([
                'users_id'       => $user->id,
                'firstname'      => $user->name,
                'manager_access' => 1,
                'avatar'         => config('paths.image_path').'4.jpg',
            ]);

            return $user;
        }
        else if( $ch->first()->login_flag == 0 )
        {
            $ch->update(['login_flag', 1]);
            return $ch->first();
        }
        else
        {
            return $ch->first();
        }
    }
}
