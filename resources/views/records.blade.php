@extends('layouts.app')

@section('content')
	{{Form::model($team, ['method' => 'POST', 'url' => 'team/update', 'files' => true])}}
		@include('partials.create-team-form', ['submitButton' => 'Update'])
	{{Form::close()}}
@endsection
