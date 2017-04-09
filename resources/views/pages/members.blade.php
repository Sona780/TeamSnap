@extends('layouts.new', ['team' => $id, 'active' => 'members', 'logo' => $team->team_logo, 'name' => $team->teamname])
@section('header')

<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/membertable.css" rel="stylesheet">
<style type="text/css">
    .bootgrid-footer .infoBar, .bootgrid-header .actionBar
     {
       text-align: right !important;
       padding: 10px;
     }

     .tab-nav
     {
       box-shadow: inset 0 0px 0 0 ;
     }
     .table-card
     {
      margin-top: 20px;
     }

    .main_tab >li >a
    {
     font-style: bold;
     font-size: 15px;
     color: #000;
    }

    .main_tab > li > a:after
     {
     background: #ffff00 !important;
     height: 3px !important;
    }
</style>
@endsection

@section('content')
<div class="pull-right">
  @if($user->manager_access == 1)
    <div class="btn-group m-r-20">
      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <span style="padding: 0px 15px">NEW</span>
      </button>
      <ul class="dropdown-menu pull-left" role="menu" style="cursor: pointer">
        <li><a data-toggle="modal" id="add-member" data-target="#myModal1">Member</a></li>
        <li class="divider"></li>
        <li><a data-toggle="modal" data-target="#myModal">Category</a></li>
      </ul>
    </div>

    <div class="btn-group m-r-20">
      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        <span style="padding: 0px 15px">IMPORT</span>
      </button>
      <ul class="dropdown-menu pull-left" role="menu" style="cursor: pointer">
        <li><a data-toggle="modal" id="import-member" data-target="#import-members">Members</a></li>
        <li class="divider"></li>
        <li><a data-toggle="modal" id="import-ctg" data-target="#import-ctgs">Categories</a></li>
      </ul>
    </div>
  @endif

  <!-- import member modal -->
  <div id="import-members" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- Modal header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Import Members</h4>
        </div>
        <!-- Modal header -->

        {{ Form::open(['method' => 'post', 'url' => $id.'/import/members', 'id' => 'import-member-form']) }}
            @include ('partials.import-member-form')
        {{Form::close()}}

      </div>
    </div>
  </div>
  <!-- end import member modal -->

  <!-- edit member modal -->
  <div id="import-ctgs" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <!-- Modal header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Import Categories</h4>
        </div>
        {{ Form::open(['method' => 'post', 'url' => $id.'/import/ctg', 'id' => 'import-ctg-form']) }}
            @include ('partials.import-ctg-form')
        {{Form::close()}}
      </div>
    </div>
  </div>
  <!-- end edit member modal -->

  <!-- add member modal -->
  <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Member Details</h4>
        </div>

          {{Form::open(['method' => 'post', 'url' => $id.'/addmember', 'files' => true, 'id' => 'add-form'])}}
            @include ('partials.memberform')
          {{Form::close()}}

      </div>
    </div>
  </div>
  <!-- end add member modal -->

<!-- edit member modal -->
  <div id="edit-member" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center">Member Details</h4>
        </div>

          {{Form::open(['method' => 'post', 'url' => $id.'/member/edit', 'files' => true, 'id' => 'edit-form'])}}
            <input type="hidden" name="id">
            @include ('partials.memberform')
          {{Form::close()}}

      </div>
    </div>
  </div>
  <!-- end edit member modal -->

   <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Ctg</h4>
          </div>
          <div class="modal-body">
           <form action="{{url($id.'/create_ctg')}}" method="post">
             {!! csrf_field() !!}
            <div class="form-group fg-float m-b-30">
                <div class="fg-line">
                    <input type="text" class="form-control input-sm" name="ctg_name">
                    <label class="fg-label">Name of Ctg</label>
                </div>
             </div>
             <button type="submit" class="btn btn-info">Submit</button>
            </form>
           </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
   </div>


   <!-- image modal -->
  <div id="show-img" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align: center" id="member-name"></h4>
        </div>

        <div class="modal-body">
          <img id="member-img" src="" style="width:100%">
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!-- end image modal -->
</div>

<div id="main-div">

  <!-- tabs for all, players and non-player -->
  <div role="tabpanel">
        <ul class="tab-nav main_tab" role="tablist">
            <li class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
            <li><a href="#player" aria-controls="player" role="tab" data-toggle="tab">Player</a></li>
            <li><a href="#nonplayer" aria-controls="nonplayer" role="tab" data-toggle="tab">Non Player</a></li>
        </ul>
  </div>
  <!-- end tabs for all, players and non-player -->


  <div class="card table-card" id="main" style="padding: 0% 0%;">
    <div class="tab-content">
      <!-- show all members -->
      <div role="tabpanel" class="tab-pane active" id="all">

        <ul class="tab-nav ctg" role="tablist">

          <!-- create all tab -->
          <li class="active"><a href="#all0" aria-controls="all0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->


          <!-- create tab for each category -->
          @foreach($ctgs as $ctg)
            <li><a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->category_name}}</a></li>
          @endforeach
          <!-- end create tab for each category -->

        </ul>
        <div class="tab-content p-10" >

          <!-- table for all members irrespective of category -->
          <div role="tabpanel" class="tab-pane active" id="all0" >
            @include('partials.member-table', ['members' => $member['all']['all']])
          </div>
          <!-- table for all members irrespective of category -->

          <!-- table for members of each category -->
          @foreach($ctgs as $ctg)
            <div role="tabpanel" class="tab-pane" id="all{{$ctg->id}}" >
               @include('partials.member-table', ['members' => $member['all'][$ctg->id]])
            </div>
          @endforeach
          <!-- table for members of each category -->

        </div><!--div class tabb content-->

      </div>
      <!-- end show all members -->


      <!-- show players only -->
      <div role="tabpanel" class="tab-pane" id="player">

        <ul class="tab-nav ctg" role="tablist" >

          <!-- create all tab -->
          <li class="active"><a href="#player0" aria-controls="player0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->


          <!-- create tab for each category -->
          @foreach($ctgs as $ctg)
            <li><a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->category_name}}</a></li>
          @endforeach
          <!-- end create tab for each category -->

        </ul>
        <div class="tab-content p-10">

          <!-- table for player members irrespective of category -->
          <div role="tabpanel" class="tab-pane active" id="player0" >
            @include('partials.member-table', ['members' => $member['player']['all']])
          </div>
          <!-- table for player members irrespective of category -->

          <!-- table for members of each category -->
          @foreach($ctgs as $ctg)
            <div role="tabpanel" class="tab-pane" id="player{{$ctg->id}}" >
               @include('partials.member-table', ['members' => $member['player'][$ctg->id]])
            </div>
          @endforeach
          <!-- table for members of each category -->

        </div><!--div class tabb content-->

      </div>
      <!-- end show players only -->


      <!-- show non-players only -->
      <div role="tabpanel" class="tab-pane" id="nonplayer">

        <ul class="tab-nav ctg" role="tablist" >

          <!-- create all tab -->
          <li class="active"><a href="#nonplayer0" aria-controls="nonplayer0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->

        </ul>
        <div class="tab-content p-10">

          <!-- table for player members irrespective of category -->
          <div role="tabpanel" class="tab-pane active" id="nonplayer0" >
            @include('partials.member-table', ['members' => $member['non']])
          </div>
          <!-- table for player members irrespective of category -->

        </div><!--div class tabb content-->

      </div>
      <!-- end show non-players only -->
    </div>
  </div>
</div>



@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>

  <script type="text/javascript">

    // do stuff on page loading
    $(document).ready(function(){
      $('#add-form').find('#categories').multiselect({
        includeSelectAllOption: true
      });

      $('table').DataTable();
    });
    // do stuff on page loading


    $('#main-div').on('click', '#aimg-show', function(){
      name = $(this).attr('name');
      image = $(this).attr('image');

      $('#member-name').html(name);
      $('#member-img').attr('src', image);
    });


    //validate member form

    //call validation for new member
    $('#add-form').submit(function(e){
      e.preventDefault();
      self = this;
      memberValidate(self, 0);
    });

    //call validation for existing member
    $('#edit-form').submit(function(e){
      e.preventDefault();
      self = this;
      memberValidate(self, $(self).find('input[name="id"]').val());
    });

    //validate member form
    function memberValidate(self, id)
    {
      d     = $(self).find('input[name="birthday"]').val();
      d     = d.split("/");
      dob   = Date.parse(new Date(d[2], parseInt(d[1])-1, d[0]));
      curr  = Date.parse(new Date());

      fname = $(self).find('input[name="firstname"]');
      lname = $(self).find('input[name="lastname"]');
      email = $(self).find('input[name="email"]');

      $(self).find('strong[id^=error]').html('');

      //validate first name
      if( fname.val() == '' )
      {
        $(self).find('#error-first').html('Member\'s first name required.');
        fname.focus();
      }

      //validate last name
      else if( lname.val() == '' )
      {
        $(self).find('#error-last').html('Member\'s last name required.');
        lname.focus();
      }

      //validate email
      else if(email.val() == '')
      {
        email.focus();
        $(self).find('#error-email').html('Email is required.');
      }

      //validate DOB
      else if( dob >= curr || isNaN(dob) )
      {
        $(self).find('input[name="birthday"]').focus();
        $(self).find('#error-birth').html('Please enter a valid date of birth.');
      }

      //check if email already exists
      else
      {
        url = '{{url("/")}}/validate/email/'+id+'/'+email.val();
        $.get(url, function(cnt){
          if( cnt > 0 )
            $(self).find('#error-email').html('Email already exists.');
          else
            self.submit();
        });
      }
    }

    //end validate member form



    //code to edit member info

    //get info a member to edit it
    $('#main').on('click', '#edit', function(){
      id = $(this).attr('key');
      url = '{{url("/")}}/edit/get/' + id;

      $.get(url, function(data){
        d = data;

        $('#edit-member').find('input[name="id"]').val(id);
        $('#edit-member').find('input[name="firstname"]').val(d['details']['firstname']);
        $('#edit-member').find('input[name="lastname"]').val(d['details']['lastname']);
        $('#edit-member').find('input[name="mobile"]').val(d['details']['mobile']);

        $('#edit-member').find('#gender[value="'+d['details']['gender']+'"]').prop('checked', true);
        $('#edit-member').find('#member-type[value="'+d['team_details']['flag']+'"]').prop('checked', true);

        //categories
        ctg = [];
        for( i = 0; i < d['ctg'].length; i++ )
          ctg.push(d['ctg'][i]['categories_id']);

        $('#edit-member').find('#categories').val(ctg);
        $('#edit-member').find('#categories').multiselect('refresh');
        //end categories

        $('#edit-member').find('input[name="birthday"]').val(d['details']['birthday']);
        $('#edit-member').find('input[name="role"]').val(d['team_details']['role']);
        $('#edit-member').find('input[name="city"]').val(d['details']['city']);
        $('#edit-member').find('input[name="state"]').val(d['details']['state']);

        $('#edit-member').find('input[name="email"]').val(d['email']);

        avatar = d['details']['avatar'];
        $('#edit-member').find('input[name="profile_img"]').val(avatar); // not change

        if( avatar != '/images/gallery/members/4.jpg' )
        {
          $('#edit-member').find('#file-field').removeClass('fileinput-new').addClass('fileinput-exists');
          $('#edit-member').find('#preview').attr('src', '{{url("/")}}/'+avatar);

        }
        else
        {
          $('#edit-member').find('#file-field').addClass('fileinput-new').removeClass('fileinput-exists');
          $('#edit-member').find('#preview').removeAttr('src');
        }
      });
    });
    //end get info a member to edit it


    //if the image is changed
    $("#edit-form").find('input[name="file"]').change(function(){
      $('#edit-member').find('input[name="profile_img"]').val('changed'); // changed
    });
    //end if the image is changed


    //if the image is removed
    $("#edit-form").find('#remove_img').click(function(){
      $('#edit-member').find('input[name="profile_img"]').val('removed'); // changed
    });
    //end if the image is removed

    //code to edit member info




    // show confirmation pop-up on deleting a member
    $('#main').on('click', '#delete', function(){
          id = $(this).attr('key');

          swal({
              title: "Are you sure?",
              text: "Selected team member will be deleted permanently!!!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url("/")}}/{{$id}}/member/delete/'+id;
          });
      });
    // show confirmation pop-up on deleting a member




    //code for member and category import

    //get categories of selected team
    $('#import-ctg-form').find('#team').change(function(){

      //id of the selected team
      tid = $(this).val();

      //show loading status
      $('#ctg-imp-load').toggle();

      //hide categories dropdown
      $('#ictg-div').hide();

      url = '{{url("/")}}/team/ctgs/'+tid;

      $.get(url, function(data){
        d = data;
        content = '';

        //get all the categories
        for( i = 0; i < d.length; i++ )
          content += '<option value="'+ d[i]['id'] +'">'+ d[i]['category_name'] +'</option>';

        //hide loading status
        $('#ctg-imp-load').toggle();

        //hide categories dropdown
        $('#ictg-div').show();

        //load all the categories in dropdown
        $('#import-ctg-form').find('#categories').html(content).selectpicker('refresh');
      });
    });
    //end get categories of selected team


    // validate import category form
    $("#import-ctg-form").submit(function(e){
      e.preventDefault();

      team = $(this).find('#team').val();
      ctg = $(this).find('#categories').val();

      if( team == '' || ctg == null )
        $('#ictg-error').html('Please select team & categories to import.');
      else
        this.submit();
    });
    // end validate import category form


    //get members of selected team
    $('#import-member-form').find('#team').change(function(){

      //id of the selected team
      tid = $(this).val();

      //show loading status
      $('#imember-load').toggle();

      //hide members dropdown
      $('#imember-div').hide();

      url = '{{url("/")}}/team/members/'+tid;

      $.get(url, function(data){
        d = data;
        content = '';

        //get all the members
        for( i = 0; i < d.length; i++ )
        {
          /*email = d[i]['email'];
          if( email != '' )
            /=email = '('+email+')';*/
          name = d[i]['firstname']+" "+d[i]['lastname'];
          content += '<option value="'+ d[i]['id'] +'">'+ name +'</option>';
        }

        //hide loading status
        $('#imember-load').toggle();

        //hide members dropdown
        $('#imember-div').show();

        //load all the members in dropdown
        $('#import-member-form').find('#members').html(content).selectpicker('refresh');
      });
    });
    //end get members of selected team


    // validate import member form
    $("#import-member-form").submit(function(e){
      e.preventDefault();

      team = $(this).find('#team').val();
      ctg = $(this).find('#members').val();

      if( team == '' || ctg == null )
        $('#imember-error').html('Please select team & members to import.');
      else
        this.submit();
    });
    // end validate import member form

    //code for member and category import
  </script>
@endsection
