@extends('layouts.new')
@section('header')
<link href="{{URL::to('/')}}/css/membertable.css" rel="stylesheet">
@endsection

@section('content')


 <div class="content container">
                
                  <ul class="nav nav-pills sub_header">
            <li class="active " ><a data-toggle="pill" href="#all">ALL</a></li>
            <li><a data-toggle="pill" href="#players">PLAYERS</a></li>
            <li><a data-toggle="pill" href="#nonplayers">NON PLAYERS</a></li>
           
          </ul>
         
          <div class="tab-content">
            
            <div id="all" class="tab-pane  active card tablehead">
               
                        <ul class="nav nav-pills">
                  
                  <li class="active"><a data-toggle="pill" href="#playingteam">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar">TOP STAR</a></li>
                  
              </ul>
                
                <div class="tab-content">
                  
                  <div id="playingteam" class="tab-pane active">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured" class="tab-pane">
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar" class="tab-pane">
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>

                   </div>
                  
                </div>
                   </div>
            <div id="players" class="tab-pane  card tablehead">
                                     
                        <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#playingteam1">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured1">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar1">TOP STAR</a></li>
            </ul>
                
                <div class="tab-content">
                  
                  <div id="playingteam1" class="tab-pane  active">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured1" class="tab-pane">
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>                  </div>
                  </div>
                  <div id="topstar1" class="tab-pane">
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>
                            
                            <tr>
                              <td>49</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>
                              
                            </tr>
                          </tbody>
                        </table>
                  </div>

                   </div>
                  
                </div>
            </div>
            <div id="nonplayers" class="tab-pane card tablehead">
                                           
                        <ul class="nav nav-pills">
                  <li class="active"><a data-toggle="pill" href="#playingteam2">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured2">INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar2">TOP STAR</a></li>
                  
              </ul>
                
                <div class="tab-content">
                  
                  <div id="playingteam2" class="tab-pane active">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured2" class="tab-pane">
                      
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar2" class="tab-pane">
                      <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Photo</th>
                              <th>Name</th>
                              <th>Contact</th>
                              <th>Position</th>
                              <th>Manager</th>
                            </tr>

                          </thead>
                          <tbody>
                            @foreach($teammembers as $member)
                            <tr>
                                  <td><img src ="/uploads/avatars/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/></td>
                                  <td>{{$member->firstname}} {{$member->lastname}} <br/>
                                      {{$member->email}}
                                  </td>
                                  <td>{{$member->mobile}}</td>
                                  <td></td>
                                   <td>
                                      <img src="/img/edit.png" data-toggle="modal" data-target="#myModal"/>
                                      <a href="/{{$member->id}}/profile/delete"><img src="/img/delete.png"></a>
                                  </td>
                            </tr>
                           @endforeach
                          </tbody>
                        </table>
                  </div>
               
                   </div>
                  
                </div>
            </div>
            
          </div>
           <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                                 {{ Form::open(array('method' => 'PATCH', 'id' => 'editform', 'name' => 'editform'))  }} 
                              <div class="modal-body">
                             
                              
                                      @include('partials.memberform')
                             
                              </div>
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-default submitinfo" >Close</button>
                               </div>
                              {{ Form::close() }}
                              
                            </div>
                          </div>
                        </div>
        </div>

@endsection

@section('footer')
<script>

 $(document).ready(function() {

    $('.submitinfo').click(function(e){
       e.preventDefault();
     var url = '{{url($memberid.'/profile/update')}}' ;
     var data = {
      'firstname': $('.firstname').val(),
      'lastname' : $('.lastname').val(),
      'email'    : $('.email').val(),
      'optradio' : $("input[name='optradio']:checked").val(),
      'mobile'   : $('.mobile').val(),
      'birthday' : $('.birthday').val(),
      'role'     : $('.role').val(),
      'city'     : $('.city').val(),
      'state'    : $('.state').val(),
      'injured'  : $('#injured').val(),
      'topstar'  : $('#topstar').val(),
      'playing'  : $('#playing').val(),
     
     };
      
     console.log(data);
     $.ajax({
        type: "PATCH",
        url: url,
        data: data,
        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
                  console.log(data);
            }
    });
             
    document.getElementById("editform").reset();
    });
     

  $("#b").addClass("active");


 });

</script>
@endsection
