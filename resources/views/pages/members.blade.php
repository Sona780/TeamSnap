@extends('layouts.new', ['team' => $id, 'active' => 'members'])
@section('header')
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
    .ctg
    {
      background-color:#4E4C4D;
      margin-top: -1.5em;
      min-height: 4em;

    }
    .ctg > li> a
    {
      color: #fff;
    }
     .ctg > li> a:hover
    {
      color: #FFF;
    }
     .ctg > li.active > a
    {
      color: #FFFF00;
    }
    .ctg > li > a:after
     {
     background: #fff !important;
     height: 0px !important;
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

    .icon-style {
      width: 40px;
      padding-left: 10px;
    }

    .mem-tab {
      font-size: 13px
    }
</style>
@endsection

@section('content')
<div class="pull-right">
  <button class="btn bgm-red waves-effect" data-toggle="modal" id="add-member" data-target="#myModal1">Add New Member </button>

  <!-- add member modal -->
  <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Member</h4>
        </div>
        <div class="modal-body">
          {{Form::open(['method' => 'post', 'url' => $id.'/addmember', 'files' => true, 'id' => 'add-form'])}}
            @include ('partials.memberform')
            <button type="submit" class="btn btn-info">Submit</button>
          {{Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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
          <h4 class="modal-title">Add Member</h4>
        </div>
        <div class="modal-body">
          {{Form::open(['method' => 'post', 'url' => $id.'/member/edit', 'files' => true, 'id' => 'edit-form'])}}
            <input type="hidden" name="id">
            @include ('partials.memberform')
            <button type="submit" class="btn btn-info">Submit</button>
          {{Form::close()}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end edit member modal -->

   <button class="btn bgm-red  waves-effect" data-toggle="modal" data-target="#myModal">Create Ctg </button>
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
</div>

<div>

  <!-- tabs for all, players and non-player -->
  <div role="tabpanel">
        <ul class="tab-nav main_tab" role="tablist">
            <li class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
            <li><a href="#player" aria-controls="player" role="tab" data-toggle="tab">Player</a></li>
            <li><a href="#nonplayer" aria-controls="nonplayer" role="tab" data-toggle="tab">Non Player</a></li>
        </ul>
  </div>
  <!-- end tabs for all, players and non-player -->


  <div class="card table-card" id="main" style="padding: 0% 0%; border-radius: 20px">
    <div class="tab-content">
      <!-- show all members -->
      <div role="tabpanel" class="tab-pane active" id="all">

        <ul class="tab-nav ctg" role="tablist" style="border-radius: 15px 15px 0px 0px">

          <!-- create all tab -->
          <li class="active"><a href="#all0" aria-controls="all0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->


          <!-- create tab for each category -->
          @foreach($ctgs as $ctg)
            <li><a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->name}}</a></li>
          @endforeach
          <!-- end create tab for each category -->

        </ul>
        <div class="tab-content">

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

        <ul class="tab-nav ctg" role="tablist" style="border-radius: 15px 15px 0px 0px">

          <!-- create all tab -->
          <li class="active"><a href="#player0" aria-controls="player0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->


          <!-- create tab for each category -->
          @foreach($ctgs as $ctg)
            <li><a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->name}}</a></li>
          @endforeach
          <!-- end create tab for each category -->

        </ul>
        <div class="tab-content">

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

        <ul class="tab-nav ctg" role="tablist" style="border-radius: 15px 15px 0px 0px">

          <!-- create all tab -->
          <li class="active"><a href="#nonplayer0" aria-controls="nonplayer0" role="tab" data-toggle="tab" >ALL</a></li>
          <!-- end create all tab -->

        </ul>
        <div class="tab-content">

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
  <script type="text/javascript">
  /*$("#edit-form").submit(function(e) {
          e.preventDefault();
          val = $('#edit-member').find('input[name="file"]').val();
          alert(val);
      });*/

    $("#edit-form").find('input[name="file"]').change(function(){
      //alert('kk');
      $('#edit-member').find('input[name="profile_img"]').val('changed'); // changed
    });

    $("#edit-form").find('#remove_img').click(function(){
      //alert('kk');
      $('#edit-member').find('input[name="profile_img"]').val('removed'); // changed
    });

    $(document).ready(function(){
      $('#add-form').find('#categories').multiselect({
        includeSelectAllOption: true
      });

      //show preview of image
      $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label"
      });
    });

    $('#main').on('click', '#edit', function(){
      id = $(this).attr('key');
      url = '{{url("/")}}/edit/get/' + id;
      //$('#categories').multiSelect();
      //window.location.href = '{{url("/")}}/edit/get/' + id;

      $.get(url, function(data){
        d = data;

        opt = ( d['details']['flag'] == 1 ) ? 1 : 0;
        $('#edit-member').find('input[name="id"]').val(id);
        $('#edit-member').find('input[name="firstname"]').val(d['details']['firstname']);
        $('#edit-member').find('input[name="lastname"]').val(d['details']['lastname']);
        $('#edit-member').find('input[name="mobile"]').val(d['details']['mobile']);
        $('#edit-member').find('#member-type').find('input[value="'+d['details']['flag']+'"]').attr('checked', true);

        //categories
        ctg = [];
        for( i = 0; i < d['ctg'].length; i++ )
          ctg.push(d['ctg'][i]['team_ctgs_id']);

        $('#edit-member').find('#categories').val(ctg);
        $('#edit-member').find('#categories').multiselect('refresh');
        //end categories

        $('#edit-member').find('input[name="birthday"]').val(d['details']['birthday']);
        $('#edit-member').find('input[name="role"]').val(d['details']['role']);
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
      });
    });

    $('#main').on('click', '#delete', function(){
          id = $(this).attr('key');

          swal({
              title: "Are you sure?",
              text: "the team member will be deleted permanently!!!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url("/")}}/{{$id}}'+id;
          });
      });
  </script>
@endsection
