@extends('layouts.new')


@section('content')

<div class="container content">
 



   {{ Form::model($article, ['method'=>'PATCH', 'url'=>$mid.'/profile/update' ]) }}

       {!! csrf_field() !!}
    
    {{ Form::close() }}

</div>


@endsection
