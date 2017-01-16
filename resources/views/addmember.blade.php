@extends('layouts.new')

@section('content')

<div class="card">
    <form action="{{url($id.'/addmember')}}" method="POST">
       {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-4">
             <h4> First Name:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="firstname" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
              <h4> Last Name:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="lastname" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Email:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="email" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Phone number:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="mobile" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Non Player</h4>
            </div>
            <div class="toggle-switch">
                <input id="ts1" type="checkbox" value="1" name="playertype" hidden="hidden">
                <label for="ts1" class="ts-helper"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Birthday:</h4>
            </div>
            <div class="col-sm-8">
                <div class="input-group form-group">
                  <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                    <div class="dtp-container fg-line">
                       <input type='text' class="form-control date-picker" name="birthday" placeholder="Click here...">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Role(s):</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="role" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> City:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="city" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> State:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm" name="state" placeholder="Prashushi">
                </div>
            </div>
        </div>
    <input type="submit" value="submit"/>
    </form>
</div>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
{{ Form::open(array('url'=>'/team_setup','files'=>true)) }}
    
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
             
             <a href="/dashboard">  
             
             <button type="button" class="btn btn-info">Save And Continue</button> </a>
         </div>
       </div>
    </div>
</div> -->

@endsection
