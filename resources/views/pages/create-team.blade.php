@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">
      <h2>Create Team <small></small></h2>
    </div>
    <div class="card-body card-padding">
      {{Form::open(['method' => 'POST', 'url' => 'store', 'files' => true, ])}}
        @include('partials.create-team-form', ['submitButton' => 'Submit'])
      {{Form::close()}}
    </div>
  </div>

@endsection

@section('footer')
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script src="{{URL::to('/')}}/vendors/fileinput/fileinput.min.js"></script>

<script>
  $(document).ready(function(){
    $('input[name="team_color_first"]').val('#03A9F4');
    $('input[name="team_color_second"]').val('#8BC34A');
    $('#first-cp').css('background-color', 'rgb(3, 169, 244)').css('color', 'rgb(255, 255, 255)');
    $('#second-cp').css('background-color', 'rgb(139, 195, 74)').css('color', 'rgb(0, 0, 0)');
  });



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
