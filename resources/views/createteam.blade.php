
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                       <p>create your own team </p>
    <form action="{{url('store')}}" method="POST">
    {!! csrf_field() !!}

      TeamName:<input type="text" name="teamname" required="required" class="form-control" /><br/>

      Sport:<input type="text" name="sport" required="required" class="form-control"/><br/>
      country:<input type="text" name="country" required="required" class="form-control"/><br/>
      Zipcode:<input type="text" name="zip" required="required" class="form-control"/><br/>
      <input type="submit" value="submit">

    </form>
    <br/>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
