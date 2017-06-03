@extends('layouts.new', $arr)
@section('header')
<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

<style type="text/css">
  .bootgrid-footer .infoBar, .bootgrid-header .actionBar
  {
    text-align: right !important;
    padding: 10px;
  }
  .tab-nav
  {
    box-shadow: inset 0 0px 0 0 #eeeeee;
  }
  .image-type{
    cursor: pointer;
  }
  .head-color{
    color: black;
    font-weight: bold;
  }

  .display{
    display: none;
  }

  a{
    cursor: pointer;
  }
</style>
@endsection
@section('content')

@if( $type == 'league' )
  <?php $i = 0; ?>
  <h5>
    @foreach($prev as $p)
      @if($i > 0)
        &nbsp;&nbsp;>&nbsp;&nbsp;
      @endif
      <a href="{{url('l/'.$id.'/d/'.$p['id'].'/dashboard')}}">{{$p['name']}}</a>
      <?php $i = 1; ?>
    @endforeach

    @if( sizeof($prev) > 0 )
      &nbsp;&nbsp;>&nbsp;&nbsp;
    @endif
    {{$curr}}
  </h5>
  <br>
@endif

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable" id='alert'>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div role="tabpanel">

  <!-- start tabs name for image management and videolink-file management -->
    <ul class="tab-nav tab-nav" role="tablist" id="myTab">
      <li @if( !Session::has('active') ) class="active" @endif><a href="#image-manage" aria-controls="home1" role="tab" data-toggle="tab">Images</a></li>
      <li @if( Session::has('active') ) class="active" @endif role="presentation">
        <a href="#videolink-files-manage" aria-controls="messages1" role="tab" data-toggle="tab">
          Video Links &nbsp;/ &nbsp;Files
        </a>
      </li>
    </ul>
  <!-- end tabs name for image management and videolink-file management -->

  <!-- start tab contents for image management and videolink-file management -->
  <div class="tab-content">

    <!-- start image upload and display management -->
    <div role="tabpanel" class="tab-pane @if( !Session::has('active') ) active @endif" id="image-manage">

      <div class="card">
        <!-- start button to upload new images -->
          <div class="card-header">
            @if( $type == 'team' )
              <span class="head-color image-type" key="team">Team Images</span>
            @endif
            <span class="image-type" style="margin-left: 10px;" key="league">League Images</span>

            @if( $mgr_access != 0 )
              <div class="pull-right upload_button">
                <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#img-upload-modal">
                  <i class="zmdi zmdi-plus"></i>
                </button>
              </div>
            @endif
          </div>
        <!-- end button to upload new images -->

        <div class="card-body">
          <!-- start show uploaded team image-->
            <div  id="image-team">
              <div class="lightbox photos">
                @foreach($images as $img)
                  <div data-src="@if($type == 'team') {{url($img->img_name)}} @else {{url($img->img_path)}} @endif" class="col-md-2 col-sm-4 col-xs-6">
                    <div class="lightbox-item p-item">
                      <img src="@if($type == 'team') {{url($img->img_name)}} @else {{url($img->img_path)}} @endif" alt="" width="180px" height="160px" />
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          <!--end show uploaded team image-->

          @if( $type == 'team' )
            <div id="image-league" style="display: none">
              <!-- start show uploaded league image-->
                @foreach($divs as $div)
                  <div class="lightbox photos">
                    @foreach($div->imgs as $img)
                      <div data-src="{{url($img->img_path)}}" class="col-md-2 col-sm-4 col-xs-6">
                        <div class="lightbox-item p-item">
                          <img src="{{url($img->img_path)}}" alt="" width="180px" height="160px" />
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endforeach
              <!--end show uploaded league images-->
            </div>
          @endif
        </div>
      </div>

      <!--Modal to upload image-->
        <div id="img-upload-modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <!-- Modal header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center">Select a image to upload</h4>
              </div>

              {{ Form::open(['method' => 'post', 'url' => $id.'/img/upload', 'files' => 'true', 'id' => 'img-upload-form']) }}
                <input type="hidden" name="type" value="{{$type}}">
                @include ('partials.img-upload-form')
              {{Form::close()}}

            </div>
          </div>
        </div>
      <!--end Modal to upload image-->

    </div>
    <!-- stop image upload and display management -->


    <!-- start tab for file and video link mamnagement -->
    <div role="tabpanel" class="tab-pane @if( Session::has('active') ) active @endif" id="videolink-files-manage">

      <!-- start video link/ file manage -->
      <div class="row">

        <!-- all video links and upload video link -->
        <div class=" col-sm-6">
          <div class="card" id="videolink-div">
            <!--  start header for video link -->
              <div class="card-header" style="background-color:#4986E7;">
                <span class="c-white f-15 ">
                  <div style="display: inline-block">
                    Video Links
                  </div>

                  @if( $type == 'team' )
                    <div class="dropdown" key="video" style="display: inline-block; margin-left: 25px">
                      <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown">Filter</a>
                        <ul class="dropdown-menu pull-left" id="vid-filter">
                          <li role="presentation" class="display all">
                            <a role="menuitem" tabindex="-1">All video links</a>
                          </li>
                          <li role="presentation" class="team">
                            <a role="menuitem" tabindex="-1">Team</a>
                          </li>
                          <li role="presentation" class="leagues">
                            <a role="menuitem" tabindex="-1">Leagues</a>
                          </li>
                          @foreach( $divs as $div )
                            <li role="presentation" class="display league" key="{{$div->league_division_id}}">
                              <a role="menuitem" tabindex="-1">League- {{$div->lname}}</a>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                  @endif

                  @if( $mgr_access != 0 )
                    <!-- button to upload new video link -->
                    <div>
                      <div class="pull-right upload_button">
                        <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#video-upload-modal">
                          <i class="zmdi zmdi-plus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- button to upload new video link -->
                  @endif

                </span>
              </div>
            <!-- end header for video link -->

            <!-- start show video links -->
              <div class="card-body" style="margin-top: 20px">
                @if( $videos->count() == 0 )
                  <div style="text-align: center">No video link available.</div>
                @else
                  <table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important; font-size: 12px">
                    <thead>
                      <tr>
                        <th style="padding-top: 20px">Video Title</th>
                        <th style="text-align: center; padding-top: 20px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($videos as $video)
                        <tr class="main-video">
                          <td>{{$video->video_title}}</td>
                          <td style="text-align: center">
                            <a href='{{$video->video_url}}' target='parent'>
                              <img class="icon-style" src='{{url("/")}}/img/play.png'>
                            </a>
                            @if( $mgr_access != 0 )
                              <a id="delete" key="{{$video->id}}">
                                <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach

                      @if( $type == 'team' )
                        @foreach( $divs as $div )
                          @foreach($div->vids as $video)
                            <tr class="div-video video-{{$div->league_division_id}}">
                              <td>{{$video->video_title}}</td>
                              <td style="text-align: center">
                                <a href='{{$video->video_url}}' target='parent'>
                                  <img class="icon-style" src='{{url("/")}}/img/play.png'>
                                </a>
                                <a style="pointer-events: none; opacity: 0.5">
                                  <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                @endif
              </div>
            <!-- end show video links -->
          </div>
        </div>
        <!-- end all video links and upload video link -->

        <!-- all files and upload files -->
        <div class=" col-sm-6">
          <div class="card" id="files-div">
            <!-- start header for files -->
              <div class="card-header" style="background-color:#4986E7;">
                <span class="c-white f-15 ">
                  <div style="display: inline-block">
                    Files
                  </div>

                  @if( $type == 'team' )
                    <div class="dropdown" key="file" style="display: inline-block; margin-left: 25px">
                      <a href="#" class="dropdown-toggle btn btn-default" data-toggle="dropdown">Filter</a>
                        <ul class="dropdown-menu pull-left" id="vid-filter">
                          <li role="presentation" class="display all">
                            <a role="menuitem" tabindex="-1">All files</a>
                          </li>
                          <li role="presentation" class="team">
                            <a role="menuitem" tabindex="-1">Team</a>
                          </li>
                          <li role="presentation" class="leagues">
                            <a role="menuitem" tabindex="-1">Leagues</a>
                          </li>
                          @foreach( $divs as $div )
                            <li role="presentation" class="display league" key="{{$div->league_division_id}}">
                              <a role="menuitem" tabindex="-1">League- {{$div->lname}}</a>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                  @endif

                  @if( $mgr_access != 0 )
                    <!-- button to upload new file -->
                    <div>
                      <div class="pull-right upload_button">
                        <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#file-upload-modal">
                          <i class="zmdi zmdi-plus"></i>
                        </button>
                      </div>
                    </div>
                    <!-- button to upload new file -->
                  @endif
                </span>
              </div>
            <!-- end header for files -->

            <!-- show files -->
              <div class="card-body" style="margin-top: 20px">
                @if( $files->count() == 0 )
                  <div style="text-align: center">No file has been uploaded yet.</div>
                @else
                  <table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important; font-size: 12px">
                    <thead>
                      <tr>
                        <th style="padding-top: 20px">File Name</th>
                        <th style="text-align: center; padding-top: 20px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($files as $file)
                        <tr class="main-file">
                          <td>{{$file->file_name}}</td>
                          <td style="text-align: center">
                            <a href='{{url("files/".$file->file_name)}}' download>
                              <img class="icon-style" src='{{url("/")}}/img/download.png'>
                            </a>
                            @if( $mgr_access != 0 )
                              <a id="delete" key="{{$file->id}}">
                                <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach

                      @if( $type == 'team' )
                        @foreach( $divs as $div )
                          @foreach($div->file as $file)
                            <tr class="div-file file-{{$div->league_division_id}}">
                              <td>{{$file->file_name}}</td>
                              <td style="text-align: center">
                                <a href='{{url("files/".$file->file_name)}}' download>
                                  <img class="icon-style" src='{{url("/")}}/img/download.png'>
                                </a>
                                <a style="pointer-events: none; opacity: 0.5">
                                  <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                @endif
              </div>
            <!-- end show files -->
          </div>
        </div>
        <!-- end all files and upload files -->

      </div>
      <!-- end video link/ file manage -->

      <!--Modal to upload file-->

      <div id="file-upload-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center">Select a File to upload</h4>
            </div>

            <!-- form to upload  file -->
            {{ Form::open(['method' => 'post', 'url' => $id.'/file/upload', 'files' => true, 'id' => 'file-upload-form']) }}
              {!! csrf_field() !!}
              <input type="hidden" name="type" value="{{$type}}">

              <!-- start file input -->
              <div class="modal-body">
                <div style="text-align: center; margin-bottom: 20px; color: red" id="error-file"></div>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <span class="btn btn-primary btn-file m-r-10">
                    <span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="file">
                  </span>
                  <span class="fileinput-filename"></span>
                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput">&times;</a>
                </div>
              </div>
              <!-- end file input -->

              <div class="modal-footer">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            {{Form::close()}}
            <!-- form to upload  file -->

          </div>
        </div>
      </div>

      <!--end Modal to upload file-->


      <!--Modal to upload video link-->

      <div id="video-upload-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center">Select a image to upload</h4>
            </div>

              {{ Form::open(['method' => 'post', 'url' => $id.'/video/upload', 'id' => 'video-upload-form']) }}
                <input type="hidden" name="type" value="{{$type}}">
                @include ('partials.video-upload-form')
              {{Form::close()}}

          </div>
        </div>
      </div>

      <!--end Modal to upload video link-->

    </div>
    <!-- end tab for file and video link mamnagement -->

  </div>
  <!-- start tab contents for image management and videolink-file management -->

</div>



@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>

  <script type="text/javascript">

    $('.all').click(function(){
      p = $(this).parent().parent();
      key = p.attr('key');
      show = [p.find('.team'), p.find('.leagues'), $('.main-'+key), $('.div-'+key)];
      hide = [$(this), p.find('.league')];

      manageFilters(show, hide, p);
    });

    $('.team').click(function(){
      p = $(this).parent().parent();
      key = p.attr('key');
      show = [p.find('.all'), p.find('.leagues'), $('.main-'+key)];
      hide = [$(this), p.find('.league'), $('.div-'+key)];

      manageFilters(show, hide, p);
    });

    $('.leagues').click(function(){
      p = $(this).parent().parent();
      key = p.attr('key');
      show = [p.find('.all'), p.find('.team'), p.find('.league'), $('.div-'+key)];
      hide = [$(this), $('.main-'+key)];

      manageFilters(show, hide, p);
    });

    $('.league').click(function(){
      p = $(this).parent().parent();
      key = p.attr('key');
      show = [$('.'+key+'-'+$(this).attr('key'))];
      hide = [$('.main-'+key), $('.div-'+key)];

      manageFilters(show, hide, p);
      $(this).addClass('active');
    });

    function manageFilters(show, hide)
    {
      for(i = 0; i < hide.length; i++)
        hide[i].hide();
      for(i = 0; i < show.length; i++)
        show[i].show();
      p.removeClass('open');
      p.find('li').removeClass('active');
    }

    @if( $type == 'team' )
      $('#image-manage').on('click', '.image-type', function(){
        type = $(this).attr('key');
        $('.image-type').removeClass('head-color');
        $(this).addClass('head-color');
        (type == 'team') ? showImages('#image-team', '#image-league') : showImages('#image-league', '#image-team');
      });

      function showImages(a, b)
      {
        $(a).css('display', 'block');
        $(b).css('display', 'none');
      }
    @endif

    // do stuff on page loading
    $(document).ready(function(){

      $('table').DataTable({'bLengthChange': false, 'bInfo': false});
      $("#alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
      });
    });
    // do stuff on page loading


    //start validating image upload form
    $("#img-upload-form").submit(function(e){
      e.preventDefault();
      img = $(this).find('input[name="image"]').val();

      if( img == '' )
        $('#iupload-error').html('Please select a image to upload.');
      else
        this.submit();
    });
    //end validating image upload form




    //start validating video link upload form
    $("#video-upload-form").submit(function(e){
      e.preventDefault();
      title = $(this).find('#title').val();
      url = $(this).find('#url').val();

      $(this).find('strong[id^=error]').html('');

      if( title == '' )
        $('#error-title').html('Title of the video is necessary.');
      else if( url == '' )
        $('#error-url').html('Please enter a valid URL.');
      else
        this.submit();
    });
    //end validating video link upload form




    // start validating file upload
    $('#file-upload-form').submit(function(e){
      e.preventDefault();
      img = $(this).find('input[name="file"]').val();
      if( img != '' )
        this.submit();
      else
        $(this).find('#error-file').html('Please select a file.');
    });
    // end validating file upload

    // show confirmation pop-up on deleting a file
    $('#files-div').on('click', '#delete', function(){
          id = $(this).attr('key');

          swal({
              title: "Are you sure?",
              text: "Selected file will be deleted permanently!!!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url("$id/$type/file/delete")}}/'+id;
          });
      });
    // show confirmation pop-up on deleting a file


    // show confirmation pop-up on deleting a video link
    $('#videolink-div').on('click', '#delete', function(){
          id = $(this).attr('key');

          swal({
              title: "Are you sure?",
              text: "Selected video link will be deleted permanently!!!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url("$id/$type/video/delete")}}/'+id;
          });
      });
    // show confirmation pop-up on deleting a video link


  </script>
@endsection
