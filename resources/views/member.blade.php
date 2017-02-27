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
        <ul class="tab-nav main_tab" role="tablist">
            <li class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
            <li><a href="#player" aria-controls="player" role="tab" data-toggle="tab">Player</a></li>
            <li><a href="#nonplayer" aria-controls="nonplayer" role="tab" data-toggle="tab">Non Player</a></li>
        </ul>
  <div class="card table-card">
        <div class="tab-content">
           <div role="tabpanel" class="tab-pane active" id="all">
               @if($ctgs == '[]')
               <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                             <thead>
                                  <tr>
                                      <th data-column-id="id" data-type="numeric">Photo</th>
                                      <th data-column-id="sender">Name</th>
                                      <th data-column-id="received" data-order="desc">Contact</th>
                                      <th data-column-id="received" data-order="desc">Position</th>
                                      <th data-column-id="received" data-order="desc">Manager</th>
                                  </tr>
                             </thead>
                             <tbody>
                                @foreach($users as $user)
                                  <tr>
                                      <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                      <td>{{$user->name}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}
                                      </td>
                                      <td>P</td>
                                      <td><img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                          <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                      </td>
                                  </tr>
                                 @endforeach 
                             </tbody>
                        </table>
                </div>
                @else
                   <ul class="tab-nav ctg" role="tablist" >
                      <?php $i=0 ?>
                      @foreach($ctgs as $ctg)
                          @if($i==0)
                          <li class="active"><a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->name}}</a></li>
                          @else
                          <li><a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->name}}</a></li>
                          
                          @endif
                          <?php $i=1?>
                      @endforeach

                   </ul>
                    <div class="tab-content">
                        <?php $i=0 ?>
                        @foreach($ctgs as $ctg)
                        
                         @if($i==0)
                         <div role="tabpanel" class="tab-pane active" id="all{{$ctg->id}}" >
                         @else
                         <div role="tabpanel" class="tab-pane" id="all{{$ctg->id}}" >
                         @endif
                          <?php $i=1?>
                           <div class="table-responsive ">
                                <table  class="table table-striped data-table-basic">
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-type="numeric">Photo</th>
                                            <th data-column-id="sender">Name</th>
                                            <th data-column-id="received" data-order="desc">Contact</th>
                                            <th data-column-id="received" data-order="desc">Position</th>
                                            <th data-column-id="received" data-order="desc">Manager</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        @foreach($users as $user)
                                         @if($user->ctg_id==$ctg->id )
                                          <tr>
                                      <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->name}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>P</td>
                                      <td><img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                          <a href="/{{$user->id}}/profile/delete"><img src="/img/delete.png"></a>
                                      </td>
                                  </tr>
                                        @endif
                                        @endforeach
                                     </tbody>
                                </table>
                            </div>
                         </div>
                         @endforeach
                    </div><!--div class tabb content--> 


                @endif   
           </div>
            <div role="tabpanel" class="tab-pane" id="player">
                @if($ctgs == '[]')
                <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                             <thead>
                                  <tr>
                                      <th data-column-id="id" data-type="numeric">Photo</th>
                                      <th data-column-id="sender">Name</th>
                                      <th data-column-id="received" data-order="desc">Contact</th>
                                      <th data-column-id="received" data-order="desc">Position</th>
                                      <th data-column-id="received" data-order="desc">Manager</th>
                                  </tr>
                             </thead>
                             <tbody>
                                @foreach($users as $user)
                                  @if($user->flag == 1 )
                                  <tr>
                                         <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->name}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>P</td>
                                      <td><img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                          <a href="/{{$user->id}}/profile/delete"><img src="/img/delete.png"></a>
                                      </td>
                                  </tr>
                                  @endif
                                 @endforeach 
                             </tbody>
                        </table>
                </div>
                @else
                   <ul class="tab-nav ctg" role="tablist">
                    <?php $i=0?>
                      @foreach($ctgs as $ctg)
                          @if($i==0)
                          <li class="active"><a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a></li>
                          @else
                          <li><a href="#player{{$ctg->id}}" aria-controls="player{{$ctg->id}}" role="tab" data-toggle="tab">{{$ctg->name}}</a></li>
                          @endif
                           <?php $i=1?>
                      @endforeach
                   </ul>
                    <div class="tab-content">
                       <?php $i=0?>
                        @foreach($ctgs as $ctg)
                         @if($i==0)
                         <div role="tabpanel" class="tab-pane active" id="player{{$ctg->id}}">
                         @else
                         <div role="tabpanel" class="tab-pane" id="player{{$ctg->id}}">
                         @endif
                          <?php $i=1?>
                           <div class="table-responsive ">
                                <table  class="table table-striped data-table-basic">
                                    <thead>
                                        <tr>
                                            <th data-column-id="id" data-type="numeric">Photo</th>
                                            <th data-column-id="sender">Name</th>
                                            <th data-column-id="received" data-order="desc">Contact</th>
                                            <th data-column-id="received" data-order="desc">Position</th>
                                            <th data-column-id="received" data-order="desc">Manager</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                        @foreach($users as $user)
                                         @if(($user->flag == 1) && ($user->ctg_id== $ctg->id))
                                        <tr>
                                              <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->name}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>P</td>
                                      <td><img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                          <a href="/{{$user->id}}/profile/delete"><img src="/img/delete.png"></a>
                                      </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                     </tbody>
                                </table>
                            </div>
                         </div>
                         @endforeach
                    </div><!--div class tabb content--> 


                @endif
            </div>
            <div role="tabpanel" class="tab-pane" id="nonplayer">
               <ul class="ctg"></ul>
               <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                             <thead>
                                  <tr>
                                     <th data-column-id="id" data-type="numeric">Photo</th>
                                      <th data-column-id="sender">Name</th>
                                      <th data-column-id="received" data-order="desc">Contact</th>
                                      <th data-column-id="received" data-order="desc">Position</th>
                                      <th data-column-id="received" data-order="desc">Manager</th>
                                  </tr>
                             </thead>
                             <tbody>
                                @foreach($users as $user)
                                  @if($user->flag == 0)
                                  <tr>
                                      <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:40px; border-radius: 50%;"/></td>
                                      <td>{{$user->name}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>P</td>
                                      <td><img src="/img/edit.png" data-toggle="modal" data-target="#myModal2"/>
                                          <a href="/{{$user->id}}/profile/delete"><img src="/img/delete.png"></a>
                                      </td>
                                  </tr>
                                  @endif
                                 @endforeach 
                             </tbody>
                        </table>
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