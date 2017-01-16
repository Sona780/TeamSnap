@extends('layouts.new')


@section('content')

<div class="container content">

   {{ Form::model($article, ['method'=>'PATCH', 'url'=>'1/profile/update' ]) }}
    
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


@endsection
