@extends('layouts.new', ['team' => $id, 'active' => 'detail', 'name' => $curr, 'ld' => $ldid])


@section('header')

<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

@endsection

@section('content')

<div role="tabpanel">
  <div id='error-div-team'></div>

  <?php $i = 0; ?>
  <h5>
    @foreach($prev as $p)
      @if($i > 0)
        &nbsp;&nbsp;>&nbsp;&nbsp;
      @endif
      <a href="{{url('l/'.$id.'/d/'.$p['id'].'/dashboard')}}">{{$p['name']}}</a>
      <?php $i = 1; ?>
    @endforeach

    @if( sizeof($prev) > 0 )
      &nbsp;&nbsp;>&nbsp;&nbsp;
    @endif
    {{$curr}}
  </h5>
  <br>

  @if( $lteams->count() == 0 && $divisions->count() == 0 )
    <div class="col-sm-6 col-sm-offset-3">
      <div class="card bs-item z-depth-5" style="text-align: center; height:50%">
        <div class="card-header">
          <h3>Create teams or divisions in {{$curr}}</h3>
        </div>
        <div class="card-body" style="height: 55%; width: 70%; margin-left: 15%">
          <p style="font-size: 15">You can add teams directly to {{$curr}}, or you can use divisions within asd to further divide up your teams. You can only choose one or the other, though.</p>
        </div>
        <div class="card-footer">
          <button  class="btn btn-info" data-toggle="modal" data-target="#team-modal">New Team</button>
          <button  class="btn btn-info" data-toggle="modal" data-target="#division-modal">New Division</button>
        </div>
      </div>
    </div>
  @endif

  <!-- start tab contents for team & divisions management -->
  <div class="tab-content">

  @if($lteams->count() > 0)
    <!-- start team management -->
    <div role="tabpanel" class="tab-pane active" id="team-manage">
      <div class="card">
        <div class="card-header">
          <span style="font-weight: bold; font-family: italic; font-size: 15px">League Teams</span>
          <div class="pull-right">
            <button  class="btn btn-info" data-toggle="modal" data-target="#team-modal">New Team</button>
          </div>
        </div>
        <hr>

        <div class="card-body">
        @if($lteams->count() > 0)
        <div class="table-responsive">
          <table class="table table-row-bordered mem-tab" style="width:100% !important">
            <thead>
              <tr>
                <th class="all" style="width: 80%">Team name</th>
                <th class="all" style="text-align: center">Manager</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lteams as $lteam)
                <tr>
                  <td>{{$lteam->teamname}}</td>
                  <td style="text-align: center">
                    <a id="delete" href="{{url('l/'.$id.'/d/'.$ldid.'/team/delete/'.$lteam->id)}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif

        </div>
      </div>
    </div>
    <!-- stop team management -->
  @elseif( $divisions->count() > 0 )

    <!-- start tab for divisions mamnagement -->
    <div role="tabpanel" class="tab-pane @if( $divisions->count() > 0) active @endif" id="division-manage">
      <div class="card">
        <div class="card-header">
          <span style="font-weight: bold; font-family: italic; font-size: 15px">League Divisions</span>
          <div class="pull-right">
            <button  class="btn btn-info" data-toggle="modal" data-target="#division-modal">New Division</button>
          </div>
        </div>
        <hr>

        <div class="card-body">
          @if( $divisions->count() > 0 )
            <div class="table-responsive">
              <table class="table table-row-bordered mem-tab" style="width:100% !important">
                <thead>
                  <tr>
                    <th class="all" style="width: 80%">Division name</th>
                    <th class="all" style="text-align: center">Manager</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($divisions as $division)
                    <tr>
                      <td><a href='{{url("l/".$id."/d/".$division->id."/dashboard")}}'>{{$division->division_name}}</a></td>
                      <td style="text-align: center">
                        <a id="delete" href="{{url('l/'.$id.'/d/'.$ldid.'/delete/'.$division->id)}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
    <!-- end tab for divisions mamnagement -->
  @endif

  </div>
  <!-- end tab contents for team & divisions management -->

</div>

  <!-- start Modal to create division -->
    <div class="modal fade" id="division-modal" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title" style="text-align: center">Team Setting</h5>
              <h6 style="text-align: center; color: red" id="error-div"></h6>
            </div>
          <!-- Modal header -->

          <!-- start form to compose reply mail -->
            {{ Form::open(['method' => 'post', 'url' => 'l/'.$id.'/d/'.$ldid.'/division/save', 'id' => 'division-form']) }}
                {!! csrf_field() !!}
                <input type="hidden" name="league_id" value="{{$id}}">
                <input type="hidden" name="parent_id" value="{{$ldid}}">
                <div class="modal-body">
                  <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label for="name">Name <small style="color: red">(required)</small></label>
                        <input type="text" class="form-control input-sm" name="division_name" required autofocus>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            {{Form::close()}}
          <!-- end form to compose reply mail -->
        </div>
      </div>
    </div>
  <!-- end Modal to create division -->

  <!-- start Modal to create team -->
    <div class="modal fade" id="team-modal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center"></h4>
            </div>
          <!-- Modal header -->

          <!-- start form to compose reply mail -->
            {{ Form::open(['method' => 'post', 'url' => 'l/'.$id.'/d/'.$ldid.'/team/save', 'id' => 'team-form']) }}
                {!! csrf_field() !!}
                <div class="modal-body">
                  <div class="col-sm-12">

                    <input type="hidden" name="league_division_id" value="{{$ldid}}">
                    <div class="col-sm-3">
                      <div class="form-group fg-line">
                          <label for="team">Team Name</label>
                          <input type="text" class="form-control input-sm" name="team_name" autofocus required>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group fg-line">
                          <label for="team">Owner First Name</label>
                          <input type="text" class="form-control input-sm" name="owner_first_name" required>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group fg-line">
                          <label for="team">Owner Last Name</label>
                          <input type="text" class="form-control input-sm" name="owner_last_name" required>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group fg-line">
                          <label for="team">Ownner Email</label>
                          <input type="email" class="form-control input-sm" name="owner_email" required>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-info">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            {{Form::close()}}
          <!-- end form to compose reply mail -->
        </div>
      </div>
    </div>
  <!-- end Modal to create team -->

@endsection

@section('footer')
<script src="{{URL::to('/')}}/js/notify.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
<script type="text/javascript">

  $('#division-form').submit(function(e){
    e.preventDefault();
    name = $(this).find('input[name="division_name"]').val();

    if( name == '' )
      $('#error-div').html('Required fields should\'t be empty.');
    else
      this.submit();
  });
</script>
@endsection
