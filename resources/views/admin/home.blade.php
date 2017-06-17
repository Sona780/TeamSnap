@extends('layouts.app')

@section('content')

@include('partials.flash-message')

<div class="mini-charts">
  <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered users</small>
              <h2>{{$users}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered Teams</small>
              <h2>{{$teams}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered Leagues</small>
              <h2>{{$leagues}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header" style="background-color:#4986E7;">
  	<span style="color: white">Owners</span>
    <div class="pull-right">
      <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#add-owner">
        <i class="zmdi zmdi-plus"></i>
      </button>
    </div>
  </div>
  <div class="table-responsive card-body">
  	@if( $owners->count() == 0 )
      <div style="text-align: center; height: 20%">No registered owner available.</div>
    @else
      <table class="table dt-responsive nowrap" cellspacing="0" style="font-size: 13px">
        <thead>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th style="text-align: center">Action</th>
        </thead>
        <hr>
        <tbody>
          @foreach( $owners as $owner )
            <tr>
            <td>{{$owner->firstname}} {{$owner->lastname}}</td>
            <td>{{$owner->email}}</td>
            <td>{{$owner->mobile}}</td>
            <td style="text-align: center">
              <a class="edit cursor" data-toggle="modal" data-target="#edit-owner" key="{{$owner->users_id}}">
                <img src="{{url('/')}}/img/edit.png" class="icon-style"/>
              </a>
              <a href='{{url("owner/$owner->users_id")}}'><img src="{{url('/')}}/img/access.png" class="icon-style"/></a>
              <a class="delete cursor" key="{{$owner->users_id}}"><img src="{{url('/')}}/img/delete.png" class="icon-style"/></a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>

<div id="add-owner" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">New owner detail</h4>
        <h6 id="error-owner" style="text-align: center; color: red"></h6>
      </div>

      {{ Form::open(['method' => 'post', 'url' => 'owner/add', 'id' => 'add-owner-form', 'type' => 'new']) }}
        <input type="hidden" name="login_flag" value="1">
        <input type="hidden" name="manager_access" value="1">
        @include ('partials.owner-form', ['submitButton' => 'Add'])
      {{Form::close()}}

    </div>
  </div>
</div>

<div id="edit-owner" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">Update owner detail</h4>
        <h6 id="error-owner" style="text-align: center; color: red"></h6>
      </div>

      {{ Form::open(['method' => 'post', 'url' => 'owner/update', 'id' => 'edit-owner-form', 'type' => 'edit']) }}
        <input type="hidden" name="user_id">
        @include ('partials.owner-form', ['submitButton' => 'Update'])
      {{Form::close()}}

    </div>
  </div>
</div>

@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/notify.js"></script>
  <script type="text/javascript">
    edit = $('#edit-owner-form');

    $(document).ready(function(){
      $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
      });
    });

    $('.edit').click(function(){
      id  = $(this).attr('key');
      url = '{{url("owner/data")}}/'+id;
      $.post(url, function(user){
        edit.parent().find('#error-owner').html('');
        edit.find('input[name="user_id"]').val(id);
        edit.find('input[name="firstname"]').val(user['name']);
        edit.find('input[name="lastname"]').val(user['detail']['lastname']);
        edit.find('input[name="email"]').val(user['email']);
        edit.find('input[name="mobile"]').val(user['detail']['mobile']);
      });
    });

    $('#add-owner-form, #edit-owner-form').submit(function(e){
      e.preventDefault();

      first = $(this).find('input[name="firstname"]').val();
      last  = $(this).find('input[name="lastname"]').val();
      email = $(this).find('input[name="email"]').val();
      phone = $(this).find('input[name="mobile"]').val();
      type  = $(this).attr('type');
      id    = (type == 'new') ? 0 : $(this).find('input[name="user_id"]').val();

      self = this;

      $(this).parent().find('#error-owner').html('');

      if( first == '' || last == '' || email == '' )
        $(this).parent().find('#error-owner').html('Required fields should not be empty.');
      else if( isNaN(Number(phone)) )
        $(this).parent().find('#error-owner').html('Contact number should only contain integer.');
      else
      {
        url = '{{url("check/email/availability")}}';
        $.post(url, {email: email, id: id}, function(ch){
          if( ch > 0 )
            $(self).parent().find('#error-owner').html('User with same email address already exists.');
          else
            self.submit();
        });
      }
    });

    $('.delete').click(function(){
      id = $(this).attr('key');
      swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true
        }, function(){
          window.location.href = '{{url("owner/delete")}}/'+id;
      });
    });
  </script>
@endsection
