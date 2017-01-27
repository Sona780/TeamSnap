@extends('layouts.new')

@section('content')

 <div role="tabpanel">
       <ul class="tab-nav tab-nav-right" role="tablist">
                <li class="active"><a href="#home1" aria-controls="home1" role="tab" data-toggle="tab">Images</a></li>
                <li role="presentation"><a href="#profile1" aria-controls="profile1" role="tab" data-toggle="tab">Vedio Link</a></li>
                <li role="presentation"><a href="#messages1" aria-controls="messages1" role="tab" data-toggle="tab">Files</a></li>
       </ul>
                              
        <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home1">
                       <div class="row">
                           
                           <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">upload img</button>
                            <!--Modal-->
                            <div class="modal fade" id="myModal" role="dialog">
              							    <div class="modal-dialog modal-lg">
              							      <div class="modal-content">
              							        <div class="modal-header">
              							          <button type="button" class="close" data-dismiss="modal">&times;</button>
              							          <h4 class="modal-title">Modal Header</h4>
              							        </div>
              							        <div class="modal-body">
              							          <div class="row">
                                                       <div class="col-sm-12">
              											<form action="{{url($id.'/files/img-upload')}}" class="dropzone" id="addImages">
              											 <input type="hidden" name="gallery_id" value="">
                                                              {{ csrf_field() }}
              											</form>
                                                       </div>
              							          </div>
              							        </div>
              							        <div class="modal-footer">
              							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              							        </div>
              							      </div>
              							    </div>
							               </div>

							           </div>
                         <div class="row">
                            @foreach($images as $img)
                            <div class="col-sm-3">
                                 <img src="/images/{{$img->img_name}}" class="img-circle img-responsive">     
                            </div>
                            @endforeach
                        </div>
                  </div>

                 <div role="tabpanel" class="tab-pane" id="profile1">
                         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">upload vedio url</button>
                            <!--Modal-->
                            <div class="modal fade" id="myModal1" role="dialog">
                							    <div class="modal-dialog modal-sm">
                							      <div class="modal-content">
                							        <div class="modal-header">
                							          <button type="button" class="close" data-dismiss="modal">&times;</button>
                							          <h4 class="modal-title">Modal Header</h4>
                							        </div>
                							        <div class="modal-body">
                							          <form action="{{url($id.'/files/upload_url')}}" method="POST">
                							              {{ csrf_field() }}
                							             Youtube url:<input type="text" name="videolink" id="videolink"/><br/>
                							             Video title:<input type="text" name="videotitle" id="videotitle"/><br/>
                							             <input type="submit" value="submit"/> 
                							          </form>
                							        </div>
                							        <div class="modal-footer">
                							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                							        </div>
                							      </div>
                							    </div>
							               </div>
                    
                    <!-- showing vedio -->
                     <div class="card-body card-padding">
                            <div class="row">
                              @foreach($videos as $video)
                                <div class="col-sm-3 m-b-20">
                                    <p class="f-500 c-black m-b-20">{{$video->video_title}}</p>
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <iframe class="embed-responsive-item" src="{{$video->video_url}}"></iframe>
                                    </div>
                                </div>
                              @endforeach
                            </div>
                      </div>      
                  </div>
                  <div role="tabpanel" class="tab-pane" id="messages1">
                      <div class="row">
                          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">upload files</button>
                            <!--Modal-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                                       <div class="col-sm-12">
                                            <form action="{{url($id.'/files/file-upload')}}" class="dropzone" id="addImages">
                                             <input type="hidden" name="file_id" value="">
                                              {{ csrf_field() }}
                                            </form>
                                                       </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                       </div> 
                       <div class="row">
                            @foreach($files as $file)
                            <div class="col-sm-3">
                                   
                                 <iframe src="/files/{{$file->file_name}}" frameborder="2"></iframe>  
                            </div>
                            @endforeach
                        </div>      
                   </div>
                                   
        </div>
  </div>


@endsection

@section('footer')
  <!--    <script src="{{URL::to('/')}}/js/dropzone.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
   <script type="text/javascript">
   	   Dropzone.options.imageUpload = {
            maxFilesize         :       1,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
   </script>
@endsection