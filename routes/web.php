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

                Route::group(['prefix' => '{id}'], function () {
                   
                    Route::get('userprofile','UserController@index');
                    Route::post('userprofile','UserController@store');
                    
                    //Route::any('team_setup','AddmemberController@store');
                    //Route::get('addmember','AddmemberController@index');
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
                    

                    Route::get('files','MediaController@index');
                    Route::post('files/upload_url','MediaController@upload_url');

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
                    
                    
                    Route::get('messages','MessageController@index');
                    Route::post('sendmail','MessageController@sendmail');  

                    Route::get('schedule','ScheduleController@get');

                    Route::post('new/game','GameController@store');
                    Route::post('edit/game','GameController@editStore');
                    Route::get('game/delete/{game_id}','GameController@delete');

                    Route::post('new/event','EventController@store');
                    Route::post('edit/event','EventController@editStore');
                    Route::get('event/delete/{event_id}','EventController@delete');
                });

            Route::get('get/teams','TeamController@getAll');

            Route::get('game/data/{game_id}','GameController@getData');
            Route::get('game/validate','GameController@vali');

            Route::get('event/data/{event_id}','EventController@getData');
            Route::get('event/validate','EventController@vali');

            Route::get('edit/get/{id}','MemberController@get');

            //get team categories to import
            Route::get('team/ctgs/{tid}','MemberController@getTeamCtgs');

            //get team members to import
            Route::get('team/members/{tid}','MemberController@getTeamMembers');
        });
    });
