@extends('layouts.new')

@section('content')


<div class="content container">
   <div class="btn-colors btn-demo"> <!-- Optional container for demo porpose only -->
      <a href="addmember">  <button class="btn bgm-cyan">Add Members</button></a>
    </div>
         
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

            <div class="content container">

                         <div class=" pull-right">

                         </div>



         <ul class="nav nav-pills sub_header">
            <li class="active " ><a data-toggle="pill" href="#all">ALL</a></li>

            <li><a data-toggle="pill" href="#players">PLAYERS</a></li>
            <li><a data-toggle="pill" href="#nonplayers">NON PLAYERS</a></li>

        </ul>

          <div class="tab-content">

            <div id="all" class="tab-pane  active card tablehead">

                <div class="tab-content">

                  <div class="pull-right" style="z-index: 9999; position: relative; margin-right: 6em; margin-top: -3.5em;">
                  <a href="addmember">
                      <button class="btn bgm-red btn-float waves-effect">
                        <i class="zmdi zmdi-plus"></i>
                      </button>
                  </a>
                  </div>

                  <div id="playingteam" class="tab-pane active">
                    <div class="table-responsive">

                        <table class="table table-striped">
                          <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Edit/Delete</th>
                            </tr>
                          </thead>
                           <tbody>
                           @foreach ($teammembers as $item)
                            <tr class="item{{$item->id}}">
                              <td>{{$item->id}}</td>
                              <td><a href="/{{$item->id}}/profile">
                                  {{$item->firstname}}
                                  </a>
                              </td>
                              <td>{{$item->lastname}}</td>
                              <td>{{$item->email}}</td>
                              <td>
                              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">edit</button>
                                  <a href="/{{$item->id}}/profile/delete"><img src="/img/delete.png">
                              </td>
                            </tr>
                             @endforeach
                          </tbody>
                        </table>
                          

                      
                       <!-- Modal -->
                      
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

                        <!-- end od modal -->
                  </div>
                  </div>
                  <div id="injured" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              <td>84</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              <td>70</td>
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
            <div id="players" class="tab-pane  card tablehead">

                        <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#playingteam1">PLAYING TEAM</a></li>
                  <li><a data-toggle="pill" href="#injured1" >INJURED</a></li>
                  <li><a data-toggle="pill" href="#topstar1" >TOP STAR</a></li>
            </ul>

                <div class="tab-content">

                  <div id="playingteam1" class="tab-pane  active">
                    <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                                @foreach ($teammembers as $member)



                            <tr>

                              @if($member->flag==0)

                              <td>{{$member->id}}</td>
                              <td>{{$member->firstname}}</td>
                              <td>{{$member->lastname}}</td>
                              <td>{{$member->email}}</td>

                               @endif
                            </tr>


                             @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured1" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              <td>58</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                            <tr>
                              <td>58</td>
                              <td>Anna</td>
                              <td>Pitt</td>
                              <td>35</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar1" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                            </tr>

                          </thead>
                          <tbody>

                                @foreach ($teammembers as $member)


                            <tr>



                              @if($member->flag==1)

                              <td>{{$member->id}}</td>
                              <td>{{$member->firstname}}</td>
                              <td>{{$member->lastname}}</td>
                              <td>{{$member->email}}</td>

                              @endif

                            </tr>

                             @endforeach
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="injured2" class="tab-pane">

                      <div class="table-responsive">
                        <table class="table table-striped">
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

                              <td>22</td>
                              <td>Anffffffna</td>
                              <td>Pitefwet</td>
                              <td>3efe5</td>

                            </tr>
                          </tbody>
                        </table>
                  </div>
                  </div>
                  <div id="topstar2" class="tab-pane">
                      <div class="table-responsive">
                        <table class="table table-striped">
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
                              <td>18</td>
                              <td>Annaefw</td>
                              <td>Pitewfwfwet</td>
                              <td>35ewfw</td>

                            </tr>
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
     };
     
     console.log(data);
     $.ajax({
        type: "PATCH",
        url: url,
        data: data,
        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.firstname + "</td><td>" + data.lastname "+</td></tr>");
            }
    })
             
    document.getElementById("editform").reset();
    });
     

$("#b").addClass("active");


 });

</script>
@endsection
