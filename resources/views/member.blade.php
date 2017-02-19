@extends('layouts.new')
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
</style>
@endsection

@section('content')
<div class="pull-right">
   <button class="btn bgm-red waves-effect" data-toggle="modal" data-target="#myModal1">Add New Member </button>
    <div id="myModal1" class="modal fade" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Member</h4>
          </div>
          <div class="modal-body">
           <form action="{{url($id.'/addmember')}}" method="post">
             @include ('partials.memberform')
             <button type="submit" class="btn btn-info">Submit</button>
            </form>
           </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
   </div>

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
 
  <div role="tabpanel">
        <ul class="tab-nav" role="tablist">
            <li class="active"><a href="#home11" aria-controls="home11" role="tab" data-toggle="tab">All</a></li>
            <li><a href="#profile11" aria-controls="profile11" role="tab" data-toggle="tab">Player</a></li>
            <li><a href="#messages11" aria-controls="messages11" role="tab" data-toggle="tab">Non Player</a></li>
        </ul>

        <div class="tab-content">
           <div role="tabpanel" class="tab-pane active" id="home11">
                <ul class="tab-nav" role="tablist">
                   <?php $i=0 ?>
                   @foreach($ctgs as $ctg)
                     
                      @if($i == 0)
                        <li class="active">
                          <a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}} </a>
                        </li>
                        @else
                        <li>
                          <a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a>
                        </li>
                        @endif
                        <?php $i += 1  ?>
                    @endforeach
                 </ul>
                 
                <div class="tab-content">
                   @if($ctgs !='')
                   @foreach($ctgs as $ctg)
                   <div role="tabpanel" class="tab-pane active" id="all{{$ctg->id}}">
                     <div class="card">
                       <div class="table-responsive ">
                        <table class="table table-striped data-table-basic">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>{{$ctg->name}}1</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                      </div>
                     </div>
                   </div>
                   
                   @endforeach
                  @endif
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile11">
                <ul class="tab-nav" role="tablist">
                   @if($ctgs != '')
                   @foreach($ctgs as $ctg)
                        <li >
                          <a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a>
                        </li>
                    @endforeach
                    @endif
                 </ul>
                 
                <div class="tab-content">
                   @if($ctgs != '')
                   @foreach($ctgs as $ctg)
                   <div role="tabpanel" class="tab-pane active" id="player{{$ctg->id}}">
                     <div class="card">
                      <div class="table-responsive ">
                        <table class="table table-striped data-table-basic">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>{{$ctg->name}}</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                      </div>
                     </div>
                   </div>
                   @endforeach
                   @endif
                
                  
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages11">
                <ul class="tab-nav" role="tablist">
                   <li>
                      <a href="#nonplayer" aria-controls="nonplayer" role="tab" data-toggle="tab"></a>
                    </li>
                    
                 </ul>
                 
                <div class="tab-content">
                  
                   <div role="tabpanel" class="tab-pane active" id="nonplayer">
                     <div class="card">
                   <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                            <thead>
                                <tr>
                                    <th data-column-id="id3" data-type="numeric">ID</th>
                                    <th data-column-id="sender4">Sender</th>
                                    <th data-column-id="received5" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                </div>
                   </div>

                  
                </div>
            </div>
        </div>
  </div>
</div>  
                            
                          
 
@endsection

@section('footer')
 <script type="text/javascript">
    $(document).ready(function(){
    //Basic Example
        $(".data-table-basic").bootgrid({
           css: {
                  icon: 'zmdi icon',
                  iconColumns: 'zmdi-view-module',
                  iconDown: 'zmdi-expand-more',
                  iconRefresh: 'zmdi-refresh',
                  iconUp: 'zmdi-expand-less'
                },
        });
             
   });
    </script>

 @endsection
<!-- 

 //datatable
  <div class="card">
                   <div class="table-responsive ">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="sender">Sender</th>
                                    <th data-column-id="received" data-order="desc">Received</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>10238</td>
                                    <td>eduardo@pingpong.com</td>
                                    <td>14.10.2013</td>
                                </tr>
                             </tbody>
                        </table>
                    </div>
                </div> -->