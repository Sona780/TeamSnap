@extends('layouts.app')


@section('content')

<div class="block-header">
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header m-b-20">
        <h2>My Teams</h2>

        <a href="{{url('createteam')}}">
          <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-plus"></i></button>
        </a>

      </div>
    </div>
  </div>
</div>

<div class="row">

       @foreach($teams as $team )
       <div class="col-sm-3">
       <div class="card bgm-teal">
            <div class="card-header">
                    <a href="{{$team->teamname}}/dashboard">
                      <h2 style="color: #fff;">{{$team->teamname}} <small>Team motto</small></h2>
                    </a>

                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" aria-expanded="false">
                                <i class="zmdi zmdi-more-vert"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a href="">Delete Team</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-body card-padding">
                  <a href="{{$team->teamname}}/dashboard " style="color: #fff;">
                    Team About/Logo
                  </a>
                </div>
            </div>
      </div>
      @endforeach

</div>

@endsection
