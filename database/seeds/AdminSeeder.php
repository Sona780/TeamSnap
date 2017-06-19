<?php

use Illuminate\Database\Seeder;
use Org4Leagues\User;
use Org4Leagues\UserDetail;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $email = 'admin@org4leagues.com';
        $pass  = bcrypt('123456');
        $first = 'Admin';
        $last  = '';

        $user = User::create([
                'name'       => $first,
        		'email'      => $email,
        		'password'   => $pass,
        		'login_flag' => 1,
        	]);
        UserDetail::create([
        		'users_id'       => $user->id,
        		'firstname'      => $first,
        		'lastname'       => $last,
        		'manager_access' => -1
        	]);
    }
}
