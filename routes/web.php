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

    // start password store for a registered user
        Route::get('register/{token}', function($token) {
            $mail = Crypt::decrypt($token);
            return view('auth.password', compact('mail'));
        });
    // end password store for a registered user

    Route::post('password/save','Auth\RegisterController@savePassword');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('home','HomeController@index')->name('home');

        // start route form UserController without team id
            // show user profile
            Route::get('profile','UserController@show');
            //update user contact info
            Route::post('update/contact','UserController@updateContact');
            //update user basic info
            Route::post('update/profile','UserController@updateBasicInfo');
            //update user avatar
            Route::post('update/avatar','UserController@updateAvatar');
        // end route form UserController without team id

        Route::post('recipients/{mid}','MessageController@getEmails');

        Route::get('validate/email/{uid}/{email}','UserController@valiMail');

        Route::group(['prefix' => '{id}'], function () {

            Route::get('member/dashboard', function($id){
                return view('pages.member-dashboard', compact('id'));
            });

            // start MemberController routes with team id
                // add new member
                Route::post('addmember','MemberController@store');
                // show all members of a team
                Route::get('members','MemberController@index');
                // edit member info
                Route::post('member/edit','MemberController@update');
                // delete a member
                Route::get('member/delete/{tuid}','MemberController@delete');
                // import the categories to team
                Route::post('import/ctg','MemberController@importCtg');
                // import the members to team
                Route::post('import/members','MemberController@importMembers');
            // end MemberController routes with team id

            Route::post('create_ctg','CategoryController@store');


            Route::get('dashboard','DashboardController@index');
            Route::post('announcement/save','DashboardController@saveAnnouncement');

            // start Routes for RecordsController with team id
                // show record page with all layers record
                Route::get('records','RecordsController@show');
                // save a player record
                Route::post('/player/record/save','RecordsController@save');
            // end Routes for RecordsController with team id

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

            // start Routes for AvailabilityController with team id
                //load messages page
                Route::get('availability','AvailabilityController@show');
            // end Routes for AvailabilityController with team id

            // start Routes for AssetsController with team id
                //show team assets
                Route::get('assets','AssetsController@show');
                //save new team fee info
                Route::post('team/fee','AssetsController@saveTeamFee');
                // save new item
                Route::post('team/item','AssetsController@saveItem');
                // updae name of the item
                Route::get('item/update/{iid}/{name}','AssetsController@updateItem');
                // delete a item
                Route::get('item/delete/{iid}','AssetsController@deleteItem');
                // update team fee detail
                Route::post('fee/data/update','AssetsController@updateFee');
                // delete team fee
                Route::get('fee/delete/{fid}','AssetsController@deleteFee');
            // end Routes for AssetsController with team id

            Route::get('schedule','ScheduleController@get');

            // start GameController routes with team id
                // create new game
                Route::post('new/game','GameController@store');
                // edit a game
                Route::post('edit/game','GameController@editStore');
                // delete a game
                Route::get('game/delete/{game_id}','GameController@delete');
            // stop GameController routes with team id

            // start EventController routes with team id
                // create new event
                Route::post('new/event','EventController@store');
                // edit a event
                Route::post('edit/event','EventController@editStore');
                // delete a event
                Route::get('event/delete/{event_id}','EventController@delete');
            // stop EventController routes with team id

            // update team info
            Route::post('team/info/save','TeamController@updateInfo');
        });

        Route::post('game/data/{game_id}','GameController@getData');
        Route::get('game/validate','GameController@vali');
        Route::post('event/data/{event_id}','EventController@getData');

        Route::get('event/validate','EventController@vali');

        // start TeamController routes without team id
            // create new team
            Route::get('team/create','TeamController@show');
            // save new team
            Route::post('store','TeamController@store');
            // edit a team
            Route::get('team/edit/{tid}','TeamController@edit');
            // update team info
            Route::post('team/update','TeamController@update');
            // delete a team
            Route::get('team/delete/{id}','TeamController@delete');
            // get all teams
            Route::get('get/teams','TeamController@getAll');
            // get all teams of a member
            Route::get('get/member/teams','TeamController@getMemberTeams');
        // end TeamController routes without team id

        // end Routes for MemberController without team id
            Route::get('edit/get/{id}','MemberController@get');
            //get team categories to import
            Route::get('team/ctgs/{tid}','MemberController@getTeamCtgs');
            //get team members to import
            Route::get('team/members/{tid}','MemberController@getTeamMembers');
        // end Routes for MemberController without team id

        // start Routes for AssetsController without team id
            // get deatail of team fee
            Route::post('get/fee/data/{fid}','AssetsController@getFeeDetail');
            // change player status to paid
            Route::post('member/fee/paid','AssetsController@updateToPaid');
            // change the amount to be paid by a player
            Route::post('member/fee/change','AssetsController@updateFeeChange');
            // change palyer status to not applicable
            Route::post('member/fee/notapply','AssetsController@updateNotApply');
            // update item tracking for player
            Route::post('item/update','AssetsController@updateItemTracking');
        // start Routes for AssetsController without team id

        // update last mail check time
        Route::get('inbox/mail/visit/update/{mid}','MessageController@lastCheckUpdate');
        //update avaiabilty of player for a game
        Route::post('availability/update','AvailabilityController@update');

        Route::get('player/games/{tuid}','RecordsController@getOpponents');
    });
});
