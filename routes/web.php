<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::group(['middlewareGroups' => ['web']], function () {
          Route::auth();
          Route::get('/', function() {
              return redirect('login');
          });
            Route::group(['middleware' => 'auth'], function () {
                Route::get('home','HomeController@index')->name('home');
                Route::get('createteam','CreateteamController@index');
                Route::post('store','CreateteamController@store');
                //Route::get('team_setup','AddmemberController@index');
               
                Route::resource('account','AccountController');
                //show user profile
                Route::get('profile','UserController@show');
                 //validate mail
                Route::get('validate/email/{uid}/{email}','UserController@valiMail');
                Route::post('recipients/{mid}','MessageController@getEmails');
                //update user contact info
                Route::post('update/contact','UserController@updateContact');
                //update user basic info
                Route::post('update/profile','UserController@updateBasicInfo');
                //get recipients
                //Route::get('{$mid}','MessageController@');
                Route::group(['prefix' => '{id}'], function () {
                   
                    Route::get('member/dashboard', function($id){
                        return view('pages.member-dashboard', compact('id'));
                    });
                    Route::post('userprofile','UserController@store');
                    Route::post('addmember','MemberController@store');
                    Route::get('members','MemberController@index');
                    Route::post('member/edit','MemberController@update');
                    Route::get('member/delete/{tuid}','MemberController@delete');
                    // import the categories to team
                    Route::post('import/ctg','MemberController@importCtg');
                    // import the members to team
                    Route::post('import/members','MemberController@importMembers');
                    Route::post('create_ctg','CategoryController@store');
                    Route::get('dashboard','DashboardController@index');
                    Route::get('profile','ProfileController@index');
                    Route::post('profile','ProfileController@update_avatar');
                    Route::get('profile/edit','ProfileController@edit');
                    Route::any('profile/update','ProfileController@update');
                    Route::get('profile/delete','ProfileController@delete');
                    
                    // start Routes for MediaController with team id
                        // to load media pages
                        Route::get('files','MediaController@index');
                        //upload a image
                        Route::post('img/upload', 'MediaController@uploadImg');
                        //upload a video
                        Route::post('video/upload', 'MediaController@uploadVideo');
                        //delete a video
                        Route::get('video/delete/{vid}', 'MediaController@deleteVideo');
                        //upload a file
                        Route::post('file/upload', 'MediaController@uploadFile');
                        //delete a file
                        Route::get('file/delete/{fid}', 'MediaController@deleteFile');
                    // end Routes for MediaController with team id
                    
                    // start Routes for MessageController with team id
                        //load messages page
                        Route::get('messages','MessageController@show');
                        // send mail
                        Route::post('message/send','MessageController@send');
                        // reply to mail
                        Route::post('message/reply','MessageController@reply');
                    // end Routes for MessageController with team id
                    // start Routes for MessageController with team id
                        //load messages page
                        Route::get('assets','AssetsController@show');
                    // end Routes for MessageController with team id
                    Route::get('schedule','ScheduleController@get');
                    Route::post('new/game','GameController@store');
                    Route::post('edit/game','GameController@editStore');
                    Route::get('game/delete/{game_id}','GameController@delete');
                    Route::post('new/event','EventController@store');
                    Route::post('edit/event','EventController@editStore');
                    Route::get('event/delete/{event_id}','EventController@delete');
                });
            Route::get('get/teams','TeamController@getAll');
            Route::get('get/member/teams','TeamController@getMemberTeams');
            Route::post('game/data/{game_id}','GameController@getData');
            Route::get('game/validate','GameController@vali');
            Route::post('event/data/{event_id}','EventController@getData');
            Route::get('event/validate','EventController@vali');
            // end Routes for MemberController without team id
                Route::get('edit/get/{id}','MemberController@get');
                //get team categories to import
                Route::get('team/ctgs/{tid}','MemberController@getTeamCtgs');
                //get team members to import
                Route::get('team/members/{tid}','MemberController@getTeamMembers');
            // end Routes for MemberController without team id
            // update last mail check time
            Route::get('inbox/mail/visit/update/{mid}','MessageController@lastCheckUpdate');
            //update avaiabilty of player for a game
            Route::post('assets/update','AssetsController@update');
        });
    });