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

                Route::group(['prefix' => '{id}'], function () {

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

               });


            });
    });
