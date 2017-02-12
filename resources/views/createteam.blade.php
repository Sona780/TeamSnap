@extends('layouts.app')
    
@section('content')
  
  <div class="card">
     <div class="card-header">
       <h2>Create Team <small>Extend form controls by adding text or buttons before, after, or on both sides of any text-based inputs.</small></h2>
     </div>
    <div class="card-body card-padding">
       <form enctype="multipart/form-data" action="{{url('/store')}}" method="POST" id="teamform" name="teamform">
         {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-6 ">                       
                <div class="input-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <div class="fg-line">
                             <input type="text" class="form-control" placeholder="Full Name" name="teamname">
                        </div>
                </div>
                <br/><br/>
                 <div class="form-group" style="padding-top: 0.75em;">
                        <label>Sport <small>(required)</small></label>
                            <select class="selectpicker sport" name="sport" >
                                  <option value="0">Sport</option>
                                  <option value="1">Non sport</option>
                            </select>
                  </div>
                  <br/><br/>
                   <div class="form-group">
                      <label>Country <small>(required)</small></label>
                          <select class="selectpicker country" data-live-search="true" name="country"  >
                                <option value="0">United States</option>
                                <option value="1">Canada</option>
                                <option value="2">India</option>
                                <option value="3">Pakistan</option>
                                <option value="4">China</option>
                                <option value="5">South Africa</option>
                           </select>
                    </div>
                    <br/><br/>

                <div class="input-group">                      
                   <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                         <div class="fg-line">
                             <input type="text" class="form-control" placeholder="Zip Code" name="zipcode">
                         </div>
                </div>
             </div>
             <div class="col-sm-2">
             </div>
             <div class="col-sm-4">
                   <div class="row ">
                    <img src ="/uploads/avatars/default.jpg" id="blah" style="width:150px; height:150px; float:left; border-radius: 50%; margin-right: 25px;" />
                   </div>
                  <div class="row">
                    <label>Team Logo</label>
                    <!-- <input type="file" name="team_logo"> -->
                    <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="team_logo">
                  </div> 
                    
             </div>

        </div>  
        <div class="row">
           <br/><br/> <input type="submit" name="submit">
        </div>      
     </form>
    
</div>  
</div>                         
                                
  

@endsection

@section('footer')
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
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
