@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">
      <h2>Create Team <small></small></h2>
    </div>
    <div class="card-body card-padding">
      {{Form::model($team, ['method' => 'POST', 'url' => 'team/update', 'files' => true, ])}}
        <input type="hidden" name="id" value="{{$tid}}">
        @include('partials.create-team-form', ['submitButton' => 'Update'])
      {{Form::close()}}
    </div>
  </div>

@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function(){
       $('#load-logo').hide();
       $('#show-logo').show();
       $('#show-logo-img').attr('src', '{{url($team->team_logo)}}');
    });

    $('#change-logo').click(function(){
      $('#load-logo').show();
      $('#show-logo').hide();
    });
  </script>
@endsection
