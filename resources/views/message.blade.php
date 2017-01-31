@extends('layouts.new')

@section('content')

   <form action="{{ url($id.'/sendmail') }}" method="post">
     
        <input type="text" name="title" placeholder="title">
       
        {{csrf_field()}}
     <label class="checkbox checkbox-inline m-r-20">
          <input type="checkbox" value="1" nane="select_all">
          <i class="input-helper"></i>    
          Select All
     </label>
     <label class="checkbox checkbox-inline m-r-20">
           <input type="checkbox" value="option2">
            <i class="input-helper"></i>    
     </label>
        <input type="submit" value="submit">
   </form>

@endsection
@section('footer')
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script>
  //  $('.submit1').click(function(e){
  //    e.preventDefault();
  //    var url = "{{ url($id.'/sendmail') }}";
  //    var data = {
  //     'team_logo': $('.team_logo').val(),
  //     'teamname' : $('.teamname').val(),
  //     'sport'    : $('.sport').val(),
  //     'zipcode'  : $('.zipcode').val(),
  //     'country'  : $('.country').val(),

  //    };
  //    team_name =$('.teamname').val();
  //     console.log(data);
  //     $.ajax({
  //       type: "POST",
  //       url: url,
  //       data: data,
  //       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  //       success: function(a) {
  //           console.log("success");
  //           console.log(a);

  //       }
  //   })

  //   document.getElementById("teamform").reset();
  // });

</script>
@endsection

