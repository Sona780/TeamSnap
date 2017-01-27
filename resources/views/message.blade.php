@extends('layouts.new')

@section('content')

   <form action="{{ url($id.'/sendmail') }}" method="post">
      <!--   <input type="email" name="mail" placeholder="Mailaddress"> -->
        <input type="text" name="title" placeholder="title">
        <input type="submit" value="submit">
        {{csrf_field()}}
   </form>

@stop