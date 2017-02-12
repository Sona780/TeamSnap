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

                Route::get('home','HomeController@index');

                Route::get('createteam','CreateteamController@index');
                Route::post('store','CreateteamController@store');

                Route::get('team_setup','AddmemberController@index');
               
                Route::resource('account','AccountController');

                Route::group(['prefix' => '{id}'], function () {
                   
                    Route::get('userprofile','UserController@index');
                    Route::post('userprofile','UserController@store');
                    
                    Route::any('team_setup','AddmemberController@store');
                    Route::get('members','AddmemberController@show');
                    Route::get('addmember','AddmemberController@index');
                    Route::post('addmember','AddmemberController@store');

                    Route::get('dashboard','DashboardController@index');
                    Route::get('profile','ProfileController@index');
                    Route::post('profile','ProfileController@update_avatar');
                    Route::get('profile/edit','ProfileController@edit');
                    Route::any('profile/update','ProfileController@update');
                    Route::get('profile/delete','ProfileController@delete');
                    
                    Route::get('files','MediaController@index');
                    Route::post('files/upload_url','MediaController@upload_url');
                    Route::post('files/img-upload', 'MediaController@img_store');
                    Route::post('files/file-upload', 'MediaController@file_store');
                    
                    
                    Route::get('messages','MessageController@index');
                    Route::post('sendmail','MessageController@sendmail');  

                   

                      

               });
                     
                     

            });
    });
