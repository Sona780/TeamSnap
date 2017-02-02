@extends('layouts.new')
@section('header')
<style type="text/css">
 ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="checkbox"][id^="cb"] {
  display: none;
}

label {
  /*border: 1px solid #fff;*/
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
 /* background-color: white;*/
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
}
</style>
@endsection
@section('content')

   <form action="{{ url($id.'/sendmail') }}" method="post">
     
        <input type="text" name="title" placeholder="title" id="title">
       
        {{csrf_field()}}
     <label class="checkbox checkbox-inline m-r-20">
          <!-- <input type="checkbox" value="1" name="select_all"> -->
          <input type="checkbox" id="checkbox-id" /> <label for="checkbox-id">Some label</label>
          <i class="input-helper"></i>    
          Select All
     </label>
     <br/>
     <?php $count = 1; ?>
     
       <ul>
         @foreach($members as $member )
		  <li><input type="checkbox" id="cb{{$count}}" class="ads_Checkbox" />
		    <label for="cb{{$count}}"><img src="/uploads/avatars/{{ $member->avatar }}" class="img-circle"  /></label>
		  </li>
		  <?php $count += 1; ?>
		  @endforeach
       </ul>
       
     
        <input type="submit" value="submit">
   </form>

@endsection
@section('footer')
 
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
<script>
   $('.submit1').click(function(e){
     e.preventDefault();
     var url = "{{ url($id.'/sendmail') }}";
     var arr = [],i=0;
     $('.ads_Checkbox:checked').each(function () {
           arr[i++] = $(this).val();
       });
       i=0;
     var data = {
       'title' : $('#title').val();
       ''

     };
     team_name =$('.teamname').val();
      console.log(data);
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(a) {
            console.log("success");
            console.log(a);

        }
    })

  //   document.getElementById("teamform").reset();
  });

</script>
@endsection

