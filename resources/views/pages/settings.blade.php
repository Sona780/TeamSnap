@extends('layouts.new', ['team' => $id, 'active' => 'settings', 'logo' => $team->team_logo, 'name' => $team->teamname, 'first' => $team->team_color_first])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
  	.a-active {
  	  background-color: cyan;
  	  font-size: 15;
  	}
    .tab-nav
    {
          box-shadow: inset 0 0px 0 0 #eeeeee;
    }
  </style>
@endsection

@section('content')

@include('partials.flash-message')

<div role="tabpanel">

  <!-- start tabs for different setting categories -->
	  <ul class="tab-nav" role="tablist" id="myTab">
      <li @if(!session('active') || (session('active') && session('active') == 1)) class="active" @endif>
        <a href="#team-settings" role="tab" data-toggle="tab">Team Setting</a>
      </li>
      <li @if(session('active') && session('active') == 2) class="active" @endif>
        <a href="#access-settings" role="tab" data-toggle="tab">Access Setting</a>
      </li>
      <li @if(session('active') && session('active') == 3)) class="active" @endif role="presentation">
        <a href="#manager-settings" role="tab" data-toggle="tab">Manager Setting</a>
      </li>
      <li @if(session('active') && session('active') == 4)) class="active" @endif role="presentation">
        <a href="#custom-fields" role="tab" data-toggle="tab">Custom Fields</a>
      </li>
      <li @if(session('active') && session('active') == 5)) class="active" @endif role="presentation">
        <a href="#site-prefs" role="tab" data-toggle="tab">Site Prefs</a>
      </li>
      <li @if(session('active') && session('active') == 6)) class="active" @endif role="presentation">
        <a href="#public-url" role="tab" data-toggle="tab">Public URL</a>
      </li>
    </ul>
  <!-- end tabs for different setting categories -->

  <!-- start tab contents for different setting categories -->
	  <div class="tab-content">
      <!-- start tab for team settings -->
        <div role="tabpanel" class="tab-pane @if(!session('active') || (session('active') && session('active') == 1)) active @endif" id="team-settings">
          <div class="col-sm-8 col-sm-offset-2 card">
            <div class="card-header">
              <span style="font-size: 15px">Team settings</span>
              <div class="pull-right">
                <button class="btn btn-info team-data" id="team-edit">Edit</button>
                <button class="btn btn-warning team-input" id="team-cancel" style="margin-right: 10px">Cancel</button>
                <button class="btn btn-info team-input" id="team-save">Save</button>
              </div>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered dt-responsive mem-tab nowrap">
                {{ Form::open(['method' => 'post', 'url' => "team/info/update", 'id' => 'team-form']) }}
                  <input type="hidden" name="id" value="{{$id}}">
                  <tbody>
                    <tr>
                      <td width="40%">Team</td>
                      <td>
                        <span class="team-data">{{$team->teamname}}</span>
                        <input type="text" class="form-control team-input" name="teamname" value="{{$team->teamname}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Sport</td>
                      <td>
                        <span class="team-data">{{$team->game_type}}</span>
                        <span class="team-input">
                          <select data-size="5" class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" title='Select game type' name="all_games_id">
                            @foreach($games as $game)
                              <option value="{{$game->id}}" @if($team->all_games_id == $game->id) selected @endif>{{$game->game_name}}</option>
                            @endforeach
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Alternate Sport Name</td>
                      <td>
                        <span class="team-data">{{$detail->alernate_sport_name}}</span>
                        <input type="text" class="form-control team-input" name="alernate_sport_name" value="{{$detail->alernate_sport_name}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">League</td>
                      <td>
                        <span class="team-data">{{$detail->league}}</span>
                        <input type="text" class="form-control team-input" name="league" value="{{$detail->league}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">League Website URL</td>
                      <td>
                        <span class="team-data">{{$detail->league_url}}</span>
                        <input type="text" class="form-control team-input" name="league_url" value="{{$detail->league_url}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Division</td>
                      <td>
                        <span class="team-data">{{$detail->division}}</span>
                        <input type="text" class="form-control team-input" name="division" value="{{$detail->division}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Season</td>
                      <td>
                        <span class="team-data">{{$detail->season}}</span>
                        <input type="text" class="form-control team-input" name="season" value="{{$detail->season}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Level</td>
                      <td>
                        <span class="team-data">{{$detail->level}}</span>
                        <span class="team-input">
                          <select class="selectpicker show-menu-arrow" data-style="grey" title='Select level' name="level">
                            <option value="Recreational" @if($detail->level == 'Recreational') selected @endif>Recreational</option>
                            <option value="Competitive" @if($detail->level == 'Competitive') selected @endif>Competitive</option>
                            <option value="School" @if($detail->level == 'School') selected @endif>School</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Age Group</td>
                      <td>
                        <span class="team-data">{{$detail->age_group}}</span>
                        <span class="team-input">
                          <select class="selectpicker show-menu-arrow" data-style="grey" name="age_group">
                            <option value="Adult" @if($detail->age_group == 'Adult') selected @endif>Adult</option>
                            <option value="19 & Below" @if($detail->age_group == '19 & Below') selected @endif>19 & Below</option>
                            <option value="18 & Below" @if($detail->age_group == '18 & Below') selected @endif>18 & Below</option>
                            <option value="17 & Below" @if($detail->age_group == '17 & Below') selected @endif>17 & Below</option>
                            <option value="16 & Below" @if($detail->age_group == '16 & Below') selected @endif>16 & Below</option>
                            <option value="15 & Below" @if($detail->age_group == '15 & Below') selected @endif>15 & Below</option>
                            <option value="14 & Below" @if($detail->age_group == '14 & Below') selected @endif>14 & Below</option>
                            <option value="13 & Below" @if($detail->age_group == '13 & Below') selected @endif>13 & Below</option>
                            <option value="12 & Below" @if($detail->age_group == '12 & Below') selected @endif>12 & Below</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Gender</td>
                      <td>
                        <span class="team-data">{{$detail->gender}}</span>
                        <span class="team-input">
                          <select class="selectpicker show-menu-arrow" data-style="grey" name="gender">
                            <option value="Boys" @if($team->gender == 'Boys') selected @endif>Boys</option>
                            <option value="Girls" @if($team->gender == 'Girls') selected @endif>Girls</option>
                            <option value="Coed" @if($team->gender == 'Coed') selected @endif>Coed</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Time Zone</td>
                      <td>
                        <span class="team-data">{{$detail->zone}}</span>
                        <span class="team-input">
                          <select data-size="5" class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" title='Select zone' name="time_zone_id">
                            @foreach($zones as $zone)
                              <option value="{{$zone->id}}" @if($detail->time_zone_id == $zone->id) selected @endif>{{$zone->zone_name}}</option>
                            @endforeach
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Country</td>
                      <td>
                        <span class="team-data">{{$team->cntry_name}}</span>
                        <span class="team-input">
                          <select data-size="5" class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" title='Select country' name="country">
                            @foreach($countries as $country)
                              <option value="{{$country->id}}" @if($team->country == $country->id) selected @endif>{{$country->country_name}}</option>
                            @endforeach
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Default Home Uniform</td>
                      <td>
                        <span class="team-data">{{$detail->home_uniform}}</span>
                        <input type="text" class="form-control team-input" name="home_uniform" value="{{$detail->home_uniform}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Default Away Uniform</td>
                      <td>
                        <span class="team-data">{{$detail->away_uniform}}</span>
                        <input type="text" class="form-control team-input" name="away_uniform" value="{{$detail->away_uniform}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Zip/Postal Code</td>
                      <td>
                        <span class="team-data">{{$team->zip}}</span>
                        <input type="text" class="form-control team-input" name="zip" value="{{$team->zip}}">
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Custom Domain Name</td>
                      <td>
                        <span class="team-data">{{$detail->custom_domain}}</span>
                        <input type="text" class="form-control team-input" name="custom_domain" value="{{$detail->custom_domain}}">
                      </td>
                    </tr>
                  </tbody>
                {{Form::close()}}
              </table>
            </div>
          </div>
        </div>
      <!-- end tab for team settings -->

      <!-- start tab for access settings -->
		    <div role="tabpanel" class="tab-pane @if(session('active') && session('active') == 2) active @endif" id="access-settings">
          <div role="tabpanel" class="col-sm-8 col-sm-offset-2 card">
            <!-- start tabs for different access categories -->
              <ul class="tab-nav tn-justified tn-icon" role="tablist" id="myTab">
                <li class=" @if(!session('sub') || (session('sub') && session('sub') == 1)) active @endif"><a class="col-xs-4" href="#public" role="tab" data-toggle="tab">Public Access</a></li>
                <li class="@if(session('sub') && session('sub') == 2) active @endif"><a class="col-xs-4" href="#manager" role="tab" data-toggle="tab">Manager Access</a></li>
              </ul>
            <!-- end tabs for different access categories -->

            <!-- start tab contents for different access categories -->
              <div class="tab-content" id="access-tabs">

              <!-- start public public view access -->
                <div role="tabpanel" class="tab-pane @if(!session('sub') || (session('sub') && session('sub') == 1)) active @endif" id="public">
                  <div class="card table-responsive" id='public-div'>
                    @include('partials.access-permission-table', ['formURL' => '/public/access/update', 'buttonKey' => 'public', 'access' => $public, 'ch' => 'team'])
                  </div>
                </div>
              <!-- stop public public view access -->

              <!-- start manager view access -->
                <div role="tabpanel" class="tab-pane @if(session('sub') && session('sub') == 2) active @endif" id="manager">
                  <div class="card table-responsive" id='manager-div'>
                    @include('partials.access-permission-table', ['formURL' => '/manager/access/update', 'buttonKey' => 'manager', 'access' => $manage, 'ch' => 'team'])
                  </div>
                </div>
              <!-- stop manager view access -->

            </div>
            <!-- end tab contents for different access categories -->
          </div>
        </div>
      <!-- end tab for access settings -->

      <!-- start tab for manager settings -->
        <div role="tabpanel" class="tab-pane @if(session('active') && session('active') == 3) active @endif" id="manager-settings">
          <div class="col-sm-8 col-sm-offset-2 card">
            <div class="card-header">
              <span style="font-size: 15px">Manager(s)</span>
              <div class="pull-right">
                <button  class="btn btn-info" data-toggle="modal" data-target="#manager-modal">Add Manager</button>
              </div>
            </div>
            <hr>

            <div class="card-body table-responsive" id='manager-card'>
              @if( $managers->count() == 0 )
                <div style="text-align: center">No team manager(s) available.</div>
              @else
                <table class="table table-hover dt-responsive mem-tab nowrap">
                  <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="text-align: center">Actions</th>
                  </thead>
                  <tbody id='all-managers'>
                    @foreach($managers as $manager)
                      <tr>
                        <td>{{$manager->firstname}} {{$manager->lastname}}</td>
                        <td>{{$manager->email}}</td>
                        <td style="text-align: center">
                          <a id="delete" key="{{$manager->id}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
          </div>
        </div>
      <!-- end tab for manager settings -->

      <!-- start tab for custom field settings -->
        <div role="tabpanel" class="tab-pane @if(session('active') && session('active') == 4) active @endif" id="custom-fields">
          <div class="col-sm-8 col-sm-offset-2 card">
            <div class="card-header">
              <span style="font-size: 15px">Custom fields</span>
              <div class="pull-right">
                <button  class="btn btn-info" data-toggle="modal" data-target="#new-field">Add New</button>
              </div>
            </div>
            <hr>

            <div class="card-body table-responsive" id='custom-field-card'>
              @if( $fields->count() == 0 )
                <div style="text-align: center">No custom field available.</div>
              @else
                <table class="table table-hover dt-responsive mem-tab nowrap">
                  <thead>
                    <th>Feild name</th>
                    <th>Options</th>
                    <th style="text-align: center">Actions</th>
                  </thead>
                  <tbody id='all-managers'>
                    @foreach($fields as $field)
                      <tr>
                        <td>{{$field->field_name}}</td>
                        <td>{{$field->field_options}}</td>
                        <td style="text-align: center">
                          <a data-toggle="modal" data-target="#edit-field" id="edit" key="{{$field->id}}">
                            <img class="icon-style" src='{{url("/")}}/img/edit.png'>
                          </a>
                          <a id="delete" key="{{$field->id}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
            </div>
          </div>
        </div>
      <!-- end tab for custom field settings -->

      <!-- start tab for site prefs settings -->
        <div role="tabpanel" class="tab-pane @if(session('active') && session('active') == 5) active @endif" id="site-prefs">
          <div class="col-sm-8 col-sm-offset-2 card">
            <div class="card-header">
              <span style="font-size: 15px">Site Prefs</span>
              <div class="pull-right">
                <button class="btn btn-info pref-data" id="pref-edit">Edit</button>
                <button class="btn btn-warning pref-input" id="pref-cancel" style="margin-right: 10px">Cancel</button>
                <button class="btn btn-info pref-input" id="pref-save">Save</button>
              </div>
            </div>

            <div class="card-body table-responsive">
              <table class="table table-bordered dt-responsive mem-tab nowrap">
                {{ Form::open(['method' => 'post', 'url' => "team/prefs/update", 'id' => 'pref-form']) }}
                  <input type="hidden" name="id" value="{{$id}}">
                  <tbody>
                    <tr>
                      <td width="40%">Sort Player Name By</td>
                      <td>
                        <span class="pref-data">{{$prefs->sort_player}}</span>
                        <span class="pref-input">
                          <select data-size="5" class="selectpicker show-menu-arrow" data-style="grey" name="sort_player">
                            <option value="First Name" @if($prefs->sort_player == 'First Name') selected @endif>First Name</option>
                            <option value="Last Name" @if($prefs->sort_player == 'Last Name') selected @endif>Last Name</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Color Scheme</td>
                      <td>
                        <span class="pref-data">{{$prefs->color_scheme}}</span>
                        <span class="pref-input">
                          <select data-size="5" class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey"  name="color_scheme" title="Select color for theme">
                            <option value="#03A9F4">Default</option>
                            <option value="blue"  @if($prefs->color_scheme == 'blue') selected @endif>Blue</option>
                            <option value="#9C27B0"  @if($prefs->color_scheme == '#9C27B0') selected @endif>Purple</option>
                            <option value="#4CAF50"  @if($prefs->color_scheme == '#4CAF50') selected @endif>Green</option>
                            <option value="#F44336"  @if($prefs->color_scheme == '#F44336') selected @endif>Red</option>
                            <option value="#3F51B5"  @if($prefs->color_scheme == '#3F51B5') selected @endif>Indigo</option>
                            <option value="#FF5722"  @if($prefs->color_scheme == '#FF5722') selected @endif>Orange</option>
                            <option value="#9E9E9E"  @if($prefs->color_scheme == '#9E9E9E') selected @endif>Gray</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Game Notifications</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->game_notify == 1 )
                            Send game notifications to the players automatically.
                          @else
                            Don't send game notifications to the players automatically.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="game_notify" @if( $prefs->game_notify == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Send notifications automatically.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Event Notifications</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->event_notify == 1 )
                            Send event notifications to the players automatically.
                          @else
                            Don't send event notifications to the players automatically.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="event_notify" @if( $prefs->event_notify == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Send notifications automatically.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Default Availability</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->availability == 1 )
                            All team meamber's are available for new games & events.
                          @else
                            All team meamber's availabillity are blank for new games & events.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="availability" @if( $prefs->availability == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            All team meamber's are available for new games & events.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Item Tracking Privacy</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->item_tracking_privacy == 1 )
                            Tracked item status is viewable by the team.
                          @else
                            Tracked item status is not viewable by the team.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="item_tracking_privacy" @if( $prefs->item_tracking_privacy == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Tracked item status is viewable by the team.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Non-Player Item Tracking</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->non_player_item_tracking == 1 )
                            Items are tracked for non-players.
                          @else
                            Items are not tracked for non-players.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="non_player_item_tracking" @if( $prefs->non_player_item_tracking == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Track items for non-players.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Payment Tracking Privacy</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->payment_tracking_privacy == 1 )
                            Tracked payment status is viewable by the team.
                          @else
                            Tracked payment status is not viewable by the team.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="payment_tracking_privacy" @if( $prefs->payment_tracking_privacy == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Tracked payment status is not viewable by the team.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Non-Player Payment Tracking</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->non_player_payment_tracking == 1 )
                            Payments are tracked for non-players.
                          @else
                            Payments are not tracked for non-players.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="non_player_payment_tracking" @if( $prefs->non_player_payment_tracking == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Track payment for non-players.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Currency Symbol</td>
                      <td>
                        <span class="pref-data">{{$prefs->currency}}</span>
                        <span class="pref-input">
                          <select class="selectpicker show-menu-arrow" data-style="grey" name="currency">
                            <option value="€" @if($prefs->currency == '€') selected @endif>Euro (€)</option>
                            <option value="$" @if($prefs->currency == '$') selected @endif>Dollar ($)</option>
                            <option value="₹" @if($prefs->currency == '₹') selected @endif>Rupee (₹)</option>
                            <option value="£" @if($prefs->currency == '£') selected @endif>Pound (£)</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Time Display</td>
                      <td>
                        <span class="pref-data">
                          {{$prefs->time_format}}
                        </span>
                        <span class="pref-input">
                          <select class="selectpicker show-menu-arrow" data-style="grey" name="time_format">
                            <option value="12" @if( $prefs->time_format == 12 ) selected @endif>12</option>
                            <option value="24" @if( $prefs->time_format == 24 ) selected @endif>24</option>
                          </select>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Date Display</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->date_format == 0 )
                            MM/DD/YYYY
                          @else
                            DD/MM/YYYY (Global Date format)
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="date_format" @if( $prefs->date_format == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Use Global Date format (DD/MM/YYYY).
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Assignment Tracking</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->assignment_tracking == 1 )
                            Assignment status is viewable by the team.
                          @else
                            Assignment status is not viewable by the team.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="assignment_tracking" @if( $prefs->assignment_tracking == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Show assignment tracking info to the team players.
                          </label>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td width="40%">Score Tracking</td>
                      <td>
                        <span class="pref-data">
                          @if( $prefs->score_tracking == 1 )
                            Scores are entered as points for and against.
                          @else
                            Scores are entered as words.
                          @endif
                        </span>
                        <span class="pref-input checkbox m-b-15">
                          <label>
                            <input type="checkbox" value="1" name="score_tracking" @if( $prefs->score_tracking == 1 ) checked @endif>
                            <i class="input-helper"></i>
                            Enter results as points for and against.
                          </label>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                {{Form::close()}}
              </table>
            </div>
          </div>
        </div>
      <!-- end tab for site prefs settings -->

      <!-- start tab for public url settings -->
        <div role="tabpanel" class="tab-pane @if(session('active') && session('active') == 6) active @endif" id="public-url">
          <div class="col-sm-8 col-sm-offset-2 card">
            <div class="card-header">
              <span style="font-size: 15px">Public URL</span>
              <div class="pull-right">
                @if( $status == '' )
                  <button class="btn btn-info" data-toggle="modal" data-target="#create-url">Create Public URL</button>
                @else
                  <span>{{$status->team_url}}.org4leagues.com</span>
                  @if( $status->status == 0 )
                    <span style="color: red; margin-left: 10px">Not Activated</span>
                  @else
                    <span style="color: green; margin-left: 10px"">Activated</span>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      <!-- end tab for public url settings -->

	  </div>
  <!-- end tab contents for different setting categories -->

</div>

<div id="create-url" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="text-align: center">Create new field</h5>
        <h6 class="modal-title" id='new-url-error' style="text-align: center; color: red"></h6>
      </div>

      <form id="public-url-form" method="POST" action='{{url("$id/add/url")}}'>
        <div class="modal-body">
          {!! csrf_field() !!}
          <div class="form-group fg-line">
            <label for="label">URL</label>
            <div class="input-group">
              <input type="text" class="form-control input-sm" name="team_url" autofocus>
              <span class="input-group-addon">.org4leagues.com</span>
            </div>
          </div>
          <input type="hidden" name="status" value="0">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-info field-button" key="new">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div id="new-field" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="text-align: center">Create new field</h5>
        <h6 class="modal-title" id='new-field-error' style="text-align: center; color: red"></h6>
      </div>

      <div class="modal-body">
        <form id="custom-field-form" method="POST" action="{{url('add/custom_fields')}}">
          @include('partials.custom-field-form')
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info field-button" key="new">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div id="edit-field" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="text-align: center">Edit field</h5>
        <h6 class="modal-title" id='edit-field-error' style="text-align: center; color: red"></h6>
      </div>

      <div class="modal-body">
        <form id="edit-field-form" method="POST" action="{{url('update/custom_fields')}}">
          <input type="hidden" name="id">
          @include('partials.custom-field-form')
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-info field-button" key="edit">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div id="manager-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="text-align: center">Create new manager</h5>
        <h6 class="modal-title" id='manager-error' style="text-align: center; color: red"></h6>
      </div>

      	<div class="modal-body">
          <input type="hidden" id="teamleague" value="team">
      	  <div class="form-group fg-line">
            <label for="firstname">First Name <small style="color: red">(required)</small></label>
      	    <input type="text" id="firstname" class="form-control input-sm" name="firstname" autofocus>
          </div>

          <div class="form-group fg-line">
            <label for="lastname">Last Name</label>
      	    <input type="text" id="lastname" class="form-control input-sm" name="lastname">
          </div>

          <div class="form-group fg-line">
            <label for="firstname">Email <small style="color: red">(required)</small></label>
      	    <input type="text" id="email" class="form-control input-sm" name="email">
          </div>
     	</div>
     	<div class="modal-footer">
     	  <button type="button" class="btn btn-info" id='manager-button'>Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     	</div>

  	</div>
  </div>
</div>

@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/notify.js"></script>
  <script src="{{URL::to('/')}}/js/settings.js"></script>
  <script type="text/javascript">
  	cnt = {{$managers->count()}};

    $('#public-url-form').submit(function(e){
      e.preventDefault();
      url  = $(this).find('input[name="team_url"]').val();
      self = this;
      if( url == '' )
        $(this).parent().find('#new-url-error').html('Url cannot be empty string.');
      else if( url.length > 20 )
        $(this).parent().find('#new-url-error').html('URL should contain less than 20 characters.');
      else
      {
        url = '{{url("check/url")}}/'+url;
        $.post(url, function(ch){
          if( ch == 0 )
            self.submit();
          else
            $(self).parent().find('#new-url-error').html('Sorry the URL is not available.');
        });
      }
    });

    form = $('#edit-field-form');

    $('#custom-field-card').on('click', '#edit', function(){
      id = $(this).attr('key');
      url = '{{url("get/field")}}/'+id;

      $.post(url, function(data){
        type = data['field_type'];
        form.find('input[name="field_name"]').val(data['field_name']);
        form.find('input[name="id"]').val(id);
        form.find('select[name="field_type"]').val(type);
        form.find('select[name="field_type"]').selectpicker('refresh');
        form.find('textarea[name="field_options"]').val(data['field_options']);
        if( type != 'text' )
          form.find('#field-option').show();
        else
          form.find('#field-option').hide();
      });
    });

    form.find('select[name="field_type"]').change(function(){
      val = $(this).val();
      if( val != 'text' )
        form.find('#field-option').show();
      else
        form.find('#field-option').hide();
    });

    $('.field-button').click(function(){
      key = $(this).attr('key');
      f = (key == 'new') ? $('#custom-field-form') : $('#edit-field-form');

      field   = f.find('input[name="field_name"]').val();
      type    = f.find('select[name="field_type"]').val();
      options = f.find('textarea[name="field_options"]').val();

      if(field == '' || type == '')
        $('#'+key+'-field-error').html('Required fields can\'t be empty.');
      else if( type != 'text' && options == '' )
        $('#'+key+'-field-error').html('Options for the field required.');
      else
        f.submit();
    });

    $('#custom-field-form').find('select[name="field_type"]').change(function(){
      val = $(this).val();
      if( val != 'text' )
        $('#custom-field-form').find('#field-option').show();
      else
        $('#custom-field-form').find('#field-option').hide();
    });

  // start when team setting edit button clicked
    $('#team-edit').click(function(){
      $('.team-input').show();
      $('.team-data').hide();
      $('input[name="teamname"]').focus();
    });
  // end when team setting edit button clicked

  // start when team setting cancel button clicked
    $('#team-cancel').click(function(){
      $('.team-input').hide();
      $('.team-data').show();
    });
  // end when team setting cancel button clicked

  // start when team settings updated
    $('#team-save').click(function(){
      $('#team-form').submit();
    });
  //end when team settings updated

  // start when pref settings updated
    $('#pref-save').click(function(){
      $('#pref-form').submit();
    });
  //end when pref settings updated

  // start when page is loaded
    $(document).ready(function(){
      $('.team-input').hide();
      $('.pref-input').hide();
    });
  // end when page is loaded

  // start when site prefs setting edit button clicked
    $('#pref-edit').click(function(){
      $('.pref-input').show();
      $('.pref-data').hide();
    });
  // end when site prefs setting edit button clicked

  // start when site prefs setting cancel button clicked
    $('#pref-cancel').click(function(){
      $('.pref-input').hide();
      $('.pref-data').show();
    });
  // end when site prefs setting cancel button clicked

	// start validate and save new manager
  	$('#manager-button').click(function(){
      name  = $('#firstname').val();
      email = $('#email').val();
      var re = /\S+@\S+\.\S+/;
      if( name == '' || email == '' )
        $('#manager-error').html('<br>Required fields shouldn\'t be empty.');
      else if(!re.test(email))
        $('#manager-error').html('<br>Invalid email address.');
      else
      {
        lname = $('#lastname').val();
        teamleague  = $('#manager-modal').find('#teamleague').val();
        url   = '{{url($id."/new/manager")}}';
        $.post(url, {fname: name, lname: lname, email: email, teamleague: teamleague}, function(uid){
          if( uid > 0 )
          {
            $('#manager-modal').find('input[type="text"]').val('');
            $('#manager-modal').modal('hide');
            if( cnt == 0 )
            {
              content = '<table class="table table-hover dt-responsive mem-tab nowrap"><thead><th>Name</th><th>Email</th><th style="text-align: center">Actions</th></thead><tbody id="all-managers"><tr><td>'+ name +' '+ lname +'</td><td>'+ email +'</td><td style="text-align: center"><a id="delete" key="'+ uid +'"><img class="icon-style" src="{{url("/")}}/img/delete.png"></a></td></tr></tbody></table>';
              $('#manager-card').html(content);
              cnt++;
            }
            else
            {
              $('#all-managers').append('<tr><td>'+ name +' '+ lname +'</td><td>'+ email +'</td><td style="text-align: center"><a id="delete" key="'+ uid +'"><img class="icon-style" src="{{url("/")}}/img/delete.png"></a></td></tr>');
            }
          }
          else if( uid == 0 )
            $('#manager-error').html('<br>'+name+' can\'t become manager of this team.');
          else
            $('#manager-error').html('We are unable to process your request at the moment. Please try again later.');
        });
      }
    });
  // end validate and save new manager

  	// start confirm & delete manager
    	$('#manager-card').on('click', '#delete', function(){
    		id = $(this).attr('key');
        showDeleteDialog('{{url("team/m/d")}}/'+id);
    	});
  	// end confirm & delete manager

      $('#custom-field-card').on('click', '#delete', function(){
        id = $(this).attr('key');
        showDeleteDialog('{{url("delete/field")}}/'+id);
      });

  	// start hide access edit view
      $('#access-tabs').on('click', '#cancel', function(){
        key = $(this).attr('key');

        if( key == 'public' )
        {
          div  = $('#public-div');
          data = ['{{$public->member}}', '{{$public->schedule}}', '{{$public->availability}}', '{{$public->record}}', '{{$public->media}}', '{{$public->message}}', '{{$public->asset}}', '{{$public->setting}}'];
        }
        else
        {
          div  = $('#manager-div')
          data = ['{{$manage->member}}', '{{$manage->schedule}}', '{{$manage->availability}}', '{{$manage->record}}', '{{$manage->media}}', '{{$manage->message}}', '{{$manage->asset}}', '{{$manage->setting}}'];
        }

        cancelEdit(div, data, $(this));
      });
    // end hide access edit view
  </script>


@endsection
