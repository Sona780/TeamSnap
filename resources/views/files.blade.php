@extends('layouts.new')
@section('header')
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
       <ul class="tab-nav tab-nav" role="tablist" id="myTab">
                <li class="active"><a href="#home1" aria-controls="home1" role="tab" data-toggle="tab">Images</a></li>
                <li role="presentation"><a href="#profile1" aria-controls="profile1" role="tab" data-toggle="tab">Video Link</a></li>
                <li role="presentation"><a href="#messages1" aria-controls="messages1" role="tab" data-toggle="tab">Files</a></li>
       </ul>
                              
        <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home1">
                       <div class="row">
                           <div class="pull-right upload_button">
                               <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#myModal">
                                 <i class="zmdi zmdi-plus"></i>
                               </button>
                            </div>
                        </div>    
                            <!--Modal-->
                        <div class="modal fade" id="myModal" role="dialog">
              							    <div class="modal-dialog modal-lg">
                							      <div class="modal-content">
                  							        <div class="modal-header">
                  							          <button type="button" class="close" data-dismiss="modal">&times;</button>
                  							          <h4 class="modal-title">Upload Images</h4>
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
                							          <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                							        </div>
                							      </div>
              							    </div>
							         </div>

							          <div class="card-body card-padding">                     
                             <div class="lightbox photos">
                                @foreach($images as $img)
                                 <div data-src="/images/{{$img->img_name}}" class="col-md-2 col-sm-4 col-xs-6">
                                     <div class="lightbox-item p-item">
                                         <img src="/images/{{$img->img_name}}" alt="" width="180px" height="160px" />
                                     </div>
                                 </div>
                                @endforeach  
                              </div>
                        </div>        

                </div>

                 <div role="tabpanel" class="tab-pane" id="profile1">
                     <!--     <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1">upload video url</button> -->
                           <div class="pull-right">
                               <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float " data-toggle="modal" data-target="#myModal1">
                                 <i class="zmdi zmdi-plus"></i>
                               </button>
                            </div> 
                          
                            <!--Modal-->
                            <div class="modal fade" id="myModal1" role="dialog">
                							    <div class="modal-dialog ">
                							      <div class="modal-content">
                							        <div class="modal-header">
                							          <button type="button" class="close" data-dismiss="modal">&times;</button>
                							          <h4 class="modal-title">Upload Video Link</h4>
                							        </div>
                							        <div class="modal-body">
                							          <form action="{{url($id.'/files/upload_url')}}" method="POST">
                							              {{ csrf_field() }}
                							             
                                           <div class="form-group">
                                                <label>YOUTUBE URL <small>(required)</small></label>
                                                <div class="input-group">
                                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                        <div class="fg-line">
                                                             <input type="text" class="form-control" placeholder="YOUTUBE URL" name="videolink" id="videolink">
                                                        </div>
                                                </div>
                                            </div><br/><br/>
                							            
                                           <div class="form-group">
                                                <label>VIDEO TITLE <small>(required)</small></label>
                                                <div class="input-group">
                                                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                        <div class="fg-line">
                                                             <input type="text" class="form-control" placeholder="VIDEO TITLE" name="videotitle" id="videotitle">
                                                        </div>
                                                </div>
                                            </div>
                                            <br/><br/>
                							            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                							          </form>
                							        </div>
                							        <div class="modal-footer">
                							          <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
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
                         
                            <div class="pull-right">
                             <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float " data-toggle="modal" data-target="#myModal2">
                               <i class="zmdi zmdi-plus"></i>
                             </button>
                            </div> 
                            <!--Modal-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Upload FIles</h4>
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
                                      <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                       </div> 
                       <div class="row">
                            <?php $i=1 ?>
                            
                            <div class="card">
                                 <div class="table-responsive ">
                                      <table  class="table table-striped data-table-basic">
                                          <thead>
                                              <tr>
                                                  <th data-column-id="id" data-type="numeric">S.No</th>
                                                  <th data-column-id="sender">Filename</th>
                                                  <th data-column-id="received">Link</th>
                                              </tr>
                                           </thead>
                                           <tbody>
                                              @foreach($files as $file)
                                              <tr>
                                                  <td>{{ $i }}</td>
                                                  <td>{{$file->file_name}}</td>
                                                  <td><a href="/files/{{$file->file_name}}">Download/View</a></td>
                                              </tr>
                                               <?php $i+=1?>
                                               @endforeach
                                           </tbody>
                                      </table>
                                  </div>
                            </div>
                           
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
        $(document).ready(function(){
           $('.close_btn').click(function(){
              window.location.reload();
           });
            $(".data-table-basic").bootgrid({
        //    css: {
        //           icon: 'zmdi icon',
        //           iconColumns: 'zmdi-view-module',
        //           iconDown: 'zmdi-expand-more',
        //           iconRefresh: 'zmdi-refresh',
        //           iconUp: 'zmdi-expand-less'
        //         },
        // });
             
           
        });

   </script>
@endsection