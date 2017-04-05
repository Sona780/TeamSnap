@extends('layouts.new', ['team' => $id, 'active' => 'media', 'logo' => $team->team_logo, 'name' => $team->teamname])
@section('header')
<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

<style type="text/css">
  .bootgrid-footer .infoBar, .bootgrid-header .actionBar
     {
       text-align: right !important;
       padding: 10px;
     }
</style>
@endsection
@section('content')

<div role="tabpanel">

  <!-- start tabs name for image management and videolink-file management -->
  <ul class="tab-nav tab-nav" role="tablist" id="myTab">
    <li class="active"><a href="#image-manage" aria-controls="home1" role="tab" data-toggle="tab">Images</a></li>
    <li role="presentation">
      <a href="#videolink-files-manage" aria-controls="messages1" role="tab" data-toggle="tab">
        Video Links &nbsp;/ &nbsp;Files
      </a>
    </li>
  </ul>
  <!-- end tabs name for image management and videolink-file management -->

  <!-- start tab contents for image management and videolink-file management -->
  <div class="tab-content">

    <!-- start image upload and display management -->
    <div role="tabpanel" class="tab-pane active" id="image-manage">

      <div class="card">
        <!-- start button to upload new images -->
        <div class="card-header">
          <span style="font-weight: bold; font-family: italic; font-size: 15px">Team Images</span>

          @if( $mgr_access == 1 )
            <div class="pull-right upload_button">
              <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#img-upload-modal">
                <i class="zmdi zmdi-plus"></i>
              </button>
            </div>
          @endif
        </div>
        <!-- end button to upload new images -->


        <!--show uploaded image-->
  			<div class="card-body">
          <div class="lightbox photos">
            @foreach($images as $img)
              <div data-src="{{url($img->img_name)}}" class="col-md-2 col-sm-4 col-xs-6">
                <div class="lightbox-item p-item">
                  <img src="{{url($img->img_name)}}" alt="" width="180px" height="160px" />
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <!--end show uploaded image-->

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
                @include ('partials.img-upload-form')
              {{Form::close()}}

          </div>
        </div>
      </div>

      <!--end Modal to upload image-->

    </div>
    <!-- stop image upload and display management -->



    <!-- start tab for file and video link mamnagement -->
    <div role="tabpanel" class="tab-pane" id="videolink-files-manage">

      <!-- start video link/ file manage -->
      <div class="row">

        <!-- all video links and upload video link -->
        <div class=" col-sm-6">
          <div class="card" id="videolink-div">

            <!-- header -->
            <div class="card-header" style="background-color:#4986E7;">
              <span class="c-white f-15 ">
                Video Links

                @if( $mgr_access == 1 )
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
            <!-- end header -->

            <div class="card-body" style="margin-top: 20px">

              @if( $videos->count() == 0 )
                <div style="text-align: center">No video link present in Team directory.</div>
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
                      <tr>
                        <td>{{$video->video_title}}</td>
                        <td style="text-align: center">
                          <a href='{{$video->video_url}}' target='parent'>
                            <img class="icon-style" src='{{url("/")}}/img/play.png'>
                          </a>
                          @if( $mgr_access == 1 )
                            <a id="delete" key="{{$video->id}}">
                              <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                            </a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif

            </div>

          </div>
        </div>
        <!-- end all video links and upload video link -->

        <!-- all files and upload files -->
        <div class=" col-sm-6">
          <div class="card" id="files-div">

            <div class="card-header" style="background-color:#4986E7;">
              <span class="c-white f-15 ">
                Files

                @if( $mgr_access == 1 )
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
                      <tr>
                        <td>{{$file->file_name}}</td>
                        <td style="text-align: center">
                          <a href='{{url("files/".$file->file_name)}}' download>
                            <img class="icon-style" src='{{url("/")}}/img/download.png'>
                          </a>
                          @if( $mgr_access == 1 )
                            <a id="delete" key="{{$file->id}}">
                              <img class="icon-style" src='{{url("/")}}/img/delete.png'>
                            </a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
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

    // do stuff on page loading
    $(document).ready(function(){

      $('table').DataTable({'bLengthChange': false, 'bInfo': false});
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
                  window.location.href = '{{url($id."/file/delete")}}/'+id;
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
                  window.location.href = '{{url($id."/video/delete")}}/'+id;
          });
      });
    // show confirmation pop-up on deleting a video link


  </script>
@endsection
