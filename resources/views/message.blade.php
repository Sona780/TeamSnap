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
  /*border: 1px solid blue;
  border-radius: 50px;*/
  padding: 5px;
  display: block;
  position: relative;
  margin: 5px;
  cursor: pointer;
}

label:before {
  /*background-color: blue;*/
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
 
  height: 50px;
  width: 50px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  /*content: "✓";*/
  background-color: #00cccc;
  z-index: 2;
  transform: scale(0.6);
}

:checked + label img {
  border: 3px solid #00cccc;
  border-radius: 50px;
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
}
</style>
@endsection
@section('content')
  <div class="pull-right">
      <button  class="btn btn-danger btn-float waves-effect waves-circle waves-float" data-toggle="modal" data-target="#myModal">
       <i class="zmdi zmdi-plus"></i>
      </button>
   </div>
   <!--Modal -->
      <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                   <div class="modal-body">
                        <div class="row">
                            <form action="{{ url($id.'/sendmail') }}" method="post" name="message_form" id="message_form">
                                  <input type="text" name="title" placeholder="title" id="title"><br/>
                                  <input type="text" name="body" placeholder="body" id="body"><br/>
                                  {{csrf_field()}}
                                  <button type='button' id='selectall'>Select All</button>
                                  <br/>
                                  <?php $count = 1; ?>
                                  <ul id="example">
                                  @foreach($members as $member )
                                   <li><input type="checkbox" id="cb{{$count}}" class="member_checkbox" value="{{$member->id}}" />
                                    <label for="cb{{$count}}"><img src="/uploads/avatars/{{ $member->avatar }}" class="img-circle"/></label>
                                    <span>{{$member->firstname}}</span>
                                    </li>
                                    <?php $count += 1; ?>
                                   @endforeach
                                   </ul>
                                    <input type="button" value="submit" class="submit">
                             </form>
                          </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                      </div>
                  </div>
            </div>
       </div>  
       <div class="card">
            <div class="card-header">
                            <h2>INBOX </h2>
             </div>
                        
                        <table id="data-table-selecti" class="table table-striped table-vmiddle">
                            <thead>
                                <tr>
                                    <th data-column-id="id" data-type="numeric">Subject</th>
                                    <th data-column-id="sender">Sent To</th>
                                    <th data-column-id="date" data-order="desc">Send Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($emails as $email)
                                <tr class='parent'>
                                    <td>{{$email->title}}</td>
                                    <td>{{$email->sender_id}}</td>
                                    <td>14.10.2013</td>
                                </tr>
                                <tr class='give'>
                                    <td colspan='4'>
                                        <div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Card Title</span>
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
                                    </td>
                                </tr>
                              @endforeach  
                            </tbody>
                        </table>
           </div>
     <!--end  modal-->                          
   

@endsection
@section('footer')
 
<script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
                //Basic Example
                $("#data-table-basic").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                });
                
                //Selection
                $("#data-table-selection").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                    selection: true,
                    multiSelect: true,
                    rowSelect: true,
                    keepSelection: true
                });
                
                //Command Buttons
                $("#data-table-command").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                    formatters: {
                        "commands": function( column, row ) {
                            return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\"   data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " + 
                                "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
                        }
                    }
                });
          $('body').on('click', '#selectall', function () {
    if ($(this).hasClass('allChecked')) 
    {
        $('input[type="checkbox"]').prop('checked', false);
    } 
    else 
    {
        $('input[type="checkbox"]').prop('checked', true);
    }
    $(this).toggleClass('allChecked');
  })
 var child=$("tr.give"),parent=$("tr.parent");
      console.log("aa");
    child.hide();
     parent.click(function(){

        $(this).next().slideToggle("slow");
    });
});

   $('.submit').click(function(e){
     e.preventDefault();
     var url = "{{ url($id.'/sendmail') }}";
      var val = [] , i=0;
        $(':checkbox:checked').each(function(i){
          val[i++] = $(this).val();
        });
       i=0;
        console.log(val);
      var data = {
      'title': $('#title').val(),
      'body' : $('#body').val(),
      'val'  : val,    
     
     };
     console.log(data);
     $.ajax({
        type: "POST",
        url: url,
        data: data,
        headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        success: function(data) {
                  console.log('hello');
                  console.log(data);
                  alert('mail sent');
            }
    });
     
     

    document.getElementById("message_form").reset();
      });
        </script>

<!-- <script>
$(document).ready(function () {
   



  });

</script> -->
@endsection

