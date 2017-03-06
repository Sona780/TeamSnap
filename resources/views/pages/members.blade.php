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
          <form action="{{url($id.'/addmember')}}" method="post" id="add-form">
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
          <form action="{{url($id.'/member/edit')}}" method="post" id="edit-form">
            <input type="hidden" name="id">
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

  <div role="tabpanel">
        <ul class="tab-nav main_tab" role="tablist">
            <li class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">All</a></li>
            <li><a href="#player" aria-controls="player" role="tab" data-toggle="tab">Player</a></li>
            <li><a href="#nonplayer" aria-controls="nonplayer" role="tab" data-toggle="tab">Non Player</a></li>
        </ul>
  <div class="card table-card" id="main">
        <div class="tab-content">
           <div role="tabpanel" class="tab-pane active" id="all">
            @if( $members->count() == 0 )
              <div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
            @else
              @if($ctgs == '[]')
                <div class="table-responsive ">
                  <table  class="table table-striped data-table-basic">
                    @include('partials.table-head')
                    <tbody>
                    @foreach($members as $user)
                      <tr>
                        <td>
                          <img src ="/uploads/avatars/{{ $user->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/>
                        </td>
                        <td>{{$user->firstname}}&nbsp;&nbsp;{{$user->lastname}}</td>
                        <td>
                          <p>{{$user->email}}</p>
                          <p>{{$user->mobile}}
                        </td>
                        <td>{{$user->role}}</td>
                        <td>
                          <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$user->id}}" data-toggle="modal" data-target="#edit-member"/>
                          <a href="{{url('/')}}/{{$user->id}}/profile/delete"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
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
                    <li class="@if($i==0) active @endif"><a href="#all{{$ctg->id}}" aria-controls="all{{$ctg->id}}" role="tab" data-toggle="tab" >{{$ctg->name}}</a></li>
                    <?php $i=1?>
                  @endforeach
                </ul>
                <div class="tab-content">
                  <?php $i=0 ?>
                    @foreach($ctgs as $ctg)
                      <div role="tabpanel" class="tab-pane @if($i==0) active @endif" id="all{{$ctg->id}}" >
                        <?php $i=1?>
                       <div class="table-responsive ">
                          <table  class="table table-striped data-table-basic">
                            @include('partials.table-head')
                            <tbody>
                              @foreach($members as $user)
                                @if($user->team_ctgs_id==$ctg->id )
                                  <tr>
                                    <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                    <td>{{$user->firstname}}&nbsp;&nbsp;{{$user->lastname}}</td>
                                    <td>
                                      <p>{{$user->email}}</p>
                                      <p>{{$user->mobile}}</p>
                                    </td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                      <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$user->id}}" data-toggle="modal" data-target="#edit-member"/>
                                      <a id="delete" key="/{{$user->id}}/profile/delete"><img class="icon-style" src="{{url('/')}}/img/delete.png"></a>
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
            @endif
           </div>
            <div role="tabpanel" class="tab-pane" id="player">
              @if( $members->count() == 0 )
                <div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
              @else
                @if($ctgs == '[]')
                <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                             @include('partials.table-head')
                             <tbody>
                                @foreach($members as $user)
                                  @if($user->flag == 1 )
                                  <tr>
                                         <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->firstname}}&nbsp;&nbsp;{{$user->lastname}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>{{$user->role}}</td>
                                      <td><img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$user->id}}" data-toggle="modal" data-target="#edit-member"/>
                                          <a id="delete" key="/{{$user->id}}/profile/delete"><img class="icon-style" src="{{url('/')}}/img/delete.png"></a>
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
                         <div role="tabpanel" class="tab-pane @if($i==0) active @endif" id="player{{$ctg->id}}">
                          <?php $i=1?>
                           <div class="table-responsive ">
                                <table  class="table table-striped data-table-basic">
                                    @include('partials.table-head')
                                     <tbody>
                                        @foreach($members as $user)
                                         @if(($user->flag == 1) && ($user->team_ctgs_id== $ctg->id))
                                        <tr>
                                              <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->firstname}}&nbsp;&nbsp;{{$user->lastname}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>{{$user->role}}</td>
                                      <td><img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$user->id}}" data-toggle="modal" data-target="#edit-member"/>
                                          <a id="delete" key="/{{$user->id}}/profile/delete"><img class="icon-style" src="{{url('/')}}/img/delete.png"></a>
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
              @endif
            </div>
            <div role="tabpanel" class="tab-pane" id="nonplayer">
              @if( $members->count() == 0 )
                <div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
              @else
               <ul class="ctg"></ul>
               <div class="table-responsive ">
                        <table  class="table table-striped data-table-basic">
                             @include('partials.table-head')
                             <tbody>
                                @foreach($members as $user)
                                  @if($user->flag == 0)
                                  <tr>
                                         <td><img src ="/uploads/avatars/{{ $user->avatar }}" style="width:40px; height:4+0px; border-radius: 50%;"/></td>
                                      <td>{{$user->firstname}}&nbsp;&nbsp;{{$user->lastname}}</td>
                                      <td>
                                         <p>{{$user->email}}</p>
                                         <p>{{$user->mobile}}</p>
                                      </td>
                                      <td>{{$user->role}}</td>
                                      <td>
                                        <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$user->id}}" data-toggle="modal" data-target="#edit-member"/>
                                        <a id="delete" key="/{{$user->id}}/profile/delete"><img class="icon-style" src="{{url('/')}}/img/delete.png"></a>
                                      </td>
                                  </tr>
                                  @endif
                                @endforeach
                             </tbody>
                        </table>
                </div>
              @endif
            </div>
        </div>
  </div>
</div>



@endsection

@section('footer')
  <script type="text/javascript">
    $('#main').on('click', '#edit', function(){
      id = $(this).attr('key');
      url = '{{url("/")}}/edit/get/' + id;
      //window.location.href = '{{url("/")}}/edit/get/' + id;

      $.get(url, function(data){
        d = data;
        opt = ( d['details']['flag'] == 1 ) ? 1 : 0;
        $('#edit-member').find('input[name="id"]').val(id);
        $('#edit-member').find('input[name="firstname"]').val(d['details']['firstname']);
        $('#edit-member').find('input[name="lastname"]').val(d['details']['lastname']);
        $('#edit-member').find('input[name="mobile"]').val(d['details']['mobile']);
        $('#edit-member').find('input[name="birthday"]').val(d['details']['birthday']);
        $('#edit-member').find('input[name="role"]').val(d['details']['role']);
        $('#edit-member').find('input[name="city"]').val(d['details']['city']);
        $('#edit-member').find('input[name="state"]').val(d['details']['state']);

        $('#edit-member').find('input[name="email"]').val(d['email']);
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
