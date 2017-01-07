

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  
    <form action="add_members" method="post">
      {!! csrf_field() !!}
      FirstNAme:<input type="text" name="firstname"/><br/>
      Lastname:<input type="text" name="lastname"/><br/>
      Email<input type="text" name="email" /><br/>
          <input type="submit" value="submit"/>
    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
