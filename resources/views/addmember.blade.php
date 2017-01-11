@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
{{ Form::open(array('url'=>'team_setup','files'=>true)) }}
    
      {!! csrf_field() !!}
      FirstNAme:<input type="text" name="firstname" class="form-control" /><br/>
      Lastname:<input type="text" name="lastname" class="form-control"/><br/>
      Email<input type="text" name="email" class="form-control"/><br/>
       {!! Form::radio('ch[]', '1', false,array('id'=>'players')); !!} 
                      {!! Form::label('Player') !!}
                      <br/>                                                              
      {!! Form::radio('ch[]', '0', false,array('id'=>'nonplayers')); !!} 
      {!! Form::label('Non Player') !!}
          <input type="submit" value="submit" class="form-control"  />
    
 {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="container">
         <div class="col-sm-8">
         </div>
         <div class="col-sm-2">
             
             @foreach($teams as $team)
             <a href="{{$team->teamname}}/dashboard">  
             @endforeach
             <button type="button" class="btn btn-info">Save And Continue</button> </a>
           
         </div>
       </div>
    </div>
</div>

@endsection
