@extends('layouts.app')

@section('content')

  <div class="card">
     <div class="card-header">
       <h2>Create Team <small></small></h2>
     </div>
    <div class="card-body card-padding">
       <form enctype="multipart/form-data" action="{{url('/store')}}" method="POST" id="teamform" name="teamform">
         {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-6 ">
                <div class="form-group">
                <label>Team Name <small>(required)</small></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <div class="fg-line">
                      <input type="text" class="form-control" placeholder="Full Name" name="teamname" autofocus>
                    </div>
                    <strong style="color: #ec7475">
                      @if($errors->has('teamname'))
                        {{$errors->first('teamname')}}
                      @endif
                    </strong>
                </div>
                </div>
                <br/><br/>
                 <div class="form-group" style="padding-top: 0.75em;">
                        <label>Sport <small>(required)</small></label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-star-circle"></i></span>
                            <div class="fg-line">
                            <select class="selectpicker sport" data-live-search="true" name="sport">
                              @foreach($games as $game)
                                <option value="{{$game->id}}">{{$game->game_name}}</option>
                              @endforeach
                            </select>
                            </div>
                         </div>
                  </div>
                  <br/><br/>
                   <div class="form-group">
                      <label>Country <small>(required)</small></label>
                      <div class="input-group">
                      <span class="input-group-addon"><i class="zmdi zmdi-pin-drop"></i></span>
                          <div class="fg-line">
                          <select class="selectpicker country" data-live-search="true" name="country"  >
                                <option value="0">United States</option>
                                <option value="1">Canada</option>
                                <option value="2">India</option>
                                <option value="3">Pakistan</option>
                                <option value="4">China</option>
                                <option value="5">South Africa</option>
                           </select>
                           </div>
                       </div>
                    </div>
                    <br/><br/>
                <div class="form-group">
                <label>Zip Code <small>(required)</small></label>
                <div class="input-group">
                   <span class="input-group-addon"><i class="zmdi zmdi-info"></i></span>
                         <div class="fg-line">
                             <input type="text" class="form-control" placeholder="Zip Code" name="zipcode">
                         </div>
                         <strong style="color: #ec7475">
                          @if($errors->has('zipcode'))
                            {{$errors->first('zipcode')}}
                          @endif
                        </strong>
                </div>
                </div>
             </div>

             <div class="col-sm-5 col-sm-offset-1">

                <div class="form-group">
                <label>Team Logo </label>
                <div class="input-group">
                       <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="team_logo">
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                        </div>
                </div>
                </div>


                    <div class="form-group">
                    <label>Team Color </label>
                    <div class="cp-container">
                          <div class="input-group form-group">
                                            <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
                                            <div class="fg-line dropdown">
                                                <input type="text" class="form-control cp-value" value="#03A9F4" data-toggle="dropdown" name="team_color_first">

                                                <div class="dropdown-menu">
                                                    <div class="color-picker" data-cp-default="#03A9F4"></div>
                                                </div>

                                                <i class="cp-value"></i>
                                            </div>
                            </div>
                      </div>

                                  <br/><br/>

                                    <div class="cp-container">
                                        <div class="input-group form-group">
                                            <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
                                            <div class="fg-line dropdown">
                                                <input type="text" class="form-control cp-value" value="#8BC34A" data-toggle="dropdown" name="team_color_second">

                                                <div class="dropdown-menu">
                                                    <div class="color-picker" data-cp-default="#8BC34A"></div>
                                                </div>

                                                <i class="cp-value"></i>
                                            </div>
                                        </div>
                                    </div>
                        </div>






             </div>

        </div>
        <div class="row">
           <br/><br/>
          <button type="submit" class="btn btn-primary btn-block">Submit</button>

        </div>
     </form>

</div>
</div>



@endsection

@section('footer')
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script src="{{URL::to('/')}}/vendors/fileinput/fileinput.min.js"></script>

<script>


// $(document).ready(function(){
//   var team_name;


// $('.submit1').click(function(e){
//      e.preventDefault();
//      var url = "{{url('store')}}";
//      var data = {
//       'team_logo': $('.team_logo').val(),
//       'teamname' : $('.teamname').val(),
//       'sport'    : $('.sport').val(),
//       'zipcode'  : $('.zipcode').val(),
//       'country'  : $('.country').val(),

//      };
//      team_name =$('.teamname').val();
//       console.log(data);
//       $.ajax({
//         type: "POST",
//         url: url,
//         data: data,
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         success: function(a) {
//             console.log("success");
//             console.log(a);

//         }
//     })

//     document.getElementById("teamform").reset();
//   });


//For notification

// function notify(message, type){
//     $.growl({
//         message: message
//     },{
//         type: type,
//         allow_dismiss: false,
//         label: 'Cancel',
//         className: 'btn-xs btn-inverse',
//         placement: {
//             from: 'top',
//             align: 'right'
//         },
//         delay: 2000,
//         animate: {
//                 enter: 'animated fadeIn',
//                 exit: 'animated fadeOut'
//         },
//         offset: {
//             x: 20,
//             y: 135
//         }
//     });
// };

  //for adding members

//   $('.addmember').click(function(e){
//      e.preventDefault();

//      var url = "{{ URL::to('/') }}/"+team_name+"/team_setup";
//      var data1 = {
//       'firstname': $('.firstname').val(),
//       'lastname' : $('.lastname').val(),
//       'email'    : $('.email').val(),
//       'optradio' : $("input[name='optradio']:checked").val(),
//      };
//       console.log(data1);

//       $.ajax({
//         type: "POST",
//         url: url,
//         data: data1,
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         success: function(a) {
//             console.log("success");
//             console.log(a);
//             notify('Member added.', 'success');

//         },
//         error: function(b) {
//             notify('Sorry, member coudnt be added !', 'inverse');
//         }
//     })

//     document.getElementById("memberform").reset();
//   });



//   $('.finish').click(function(){


//      window.location.href = "{{ URL::to('/') }}/"+team_name+"/dashboard";


//   });
// });


</script>
@endsection
