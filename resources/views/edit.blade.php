@extends('layouts.new')


@section('content')

<div class="container content">

   {{ Form::model($article, ['method'=>'PATCH', 'url'=>$mid.'/profile/update' ]) }}

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
    {{ Form::close() }}

</div>


@endsection
