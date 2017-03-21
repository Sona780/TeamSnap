@extends('layouts.new', ['team' => $id, 'active' => 'messages'])
@section('header')
<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

<style type="text/css">
  ul {
    list-style-type: none;
  }

  .members-li {
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

  <!-- start Modal to compose mail -->
    <div class="modal fade" id="compose-modal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center">Compose Mail</h4>
            </div>
          <!-- Modal header -->

          <!-- start form to compose mail -->
            {{ Form::open(['method' => 'post', 'url' => $id.'/message/send', 'id' => 'message-form']) }}
                @include ('partials.message-form')
            {{Form::close()}}
          <!-- end form to compose mail -->
        </div>
      </div>
    </div>
  <!-- end Modal to compose mail -->



  <!-- start Modal to compose reply mail -->
    <div class="modal fade" id="reply-mail" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center"></h4>
            </div>
          <!-- Modal header -->

          <!-- start form to compose mail -->
            {{ Form::open(['method' => 'post', 'url' => $id.'/message/reply', 'id' => 'reply-form']) }}
                {!! csrf_field() !!}
                <div class="modal-body">
                  <div class="col-sm-12">

                    <!-- save id of mail to reply -->
                      <input type="hidden" name="eid">
                    <!-- save id of mail to reply -->

                    <!-- save id recipient -->
                      <input type="hidden" name="rid">
                    <!-- save id of recipient -->

                    <!-- start subject of reply -->
                    <div class="form-group col-sm-12">
                      <label for="recipient">To</label>
                      <input type="text" class="form-control input-sm" name="receiver" id="receiver" readonly>
                    </div>
                    <!-- end subject of reply -->

                    <!-- start subject of reply -->
                    <div class="form-group col-sm-12">
                      <label for="Subject">Subject</label>
                      <input type="text" class="form-control input-sm" name="subject" id="subject" placeholder="Write subject of mail..">
                      <strong id="error-subject" class="strong-error"></strong>
                    </div>
                    <!-- end subject of reply -->

                    <!-- start body of reply -->
                    <div class="form-group col-sm-12">
                      <label for="body">Body</label>
                      <textarea class="form-control" rows="8" id="body" name="body"></textarea>
                      <strong id="error-body" class="strong-error"></strong>
                    </div>
                    <!-- end body of reply -->

                  </div>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            {{Form::close()}}
          <!-- end form to compose mail -->
        </div>
      </div>
    </div>
  <!-- end Modal to compose reply mail -->



  <div role="tabpanel">

    <!-- start tabs name for inbox & outbox management -->
      <ul class="tab-nav tab-nav" role="tablist" id="myTab">
        <li class="active"><a href="#inbox-tab" aria-controls="inbox-tab" role="tab" data-toggle="tab">Inbox</a></li>
        <li><a href="#outbox-tab" aria-controls="outbox-tab" role="tab" data-toggle="tab">Outbox</a></li>
      </ul>
    <!-- end tabs name for inbox & outbox management -->


    <!-- start tab contents for inbox & outbox management -->
    <div class="tab-content">

      <!-- start outbox management -->
      <div role="tabpanel" class="tab-pane" id="outbox-tab">

        <div class="card">
          <!-- start button to compose new mail -->
            <div class="card-header">
              <span style="font-weight: bold; font-family: italic; font-size: 15px">Outbox History</span>
              <div class="pull-right">
                <button  class="btn btn-danger" data-toggle="modal" data-target="#compose-modal">
                  Compose
                </button>
              </div>
            </div>
          <!-- end button to compose new mail -->


          <!--show outbox mail-->
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-striped mem-tab dt-responsive nowrap" style="width:100% !important">

                  @if( $outbox->count()  == 0)
                    <div style="text-align: center">Outbox empty</div>
                  @else
                    <!-- start Head of outbox table-->
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th class="all">Recipient</th>
                          <th class="none">To</th>
                          <th class="all">Send at</th>
                          <th class="none">Body</th>
                        </tr>
                      </thead>
                    <!-- end Head of outbox table-->

                    <!-- start Body of outbox table-->
                      @foreach( $outbox as $email )
                        <tr>
                          <td>{{$email->subject}}</td>
                          <td>{{$email->to['detail']['firstname']}} {{$email->to['detail']['lastname']}}</td>
                          <td>{{$email->to['email']}}</td>
                          <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $email->send_at)->diffForHumans() }}</td>
                          <td>{{$email->body}}</td>
                        </tr>
                      @endforeach
                    <!-- end Body of outbox table-->
                  @endif

                </table>
              </div>

            </div>
          <!--end show outbox mail-->

        </div>

      </div>
      <!-- end outbox management -->


      <!-- start inbox management -->
      <div role="tabpanel" class="tab-pane active" id="inbox-tab">

        <div class="card">
          <!-- start button to compose new mail -->
            <div class="card-header">
              <span style="font-weight: bold; font-family: italic; font-size: 15px">Inbox</span>
              <div class="pull-right">
                <button  class="btn btn-danger" data-toggle="modal" data-target="#compose-modal">
                  Compose
                </button>
              </div>
            </div>
          <!-- end button to compose new mail -->


          <!--show inbox mail-->
            <div class="card-body" id="inbox-mail">

              <div class="table-responsive">
                <table class="table table-striped mem-tab dt-responsive nowrap" id="in-tab" cellspacing="0" width="100%">

                  @if( $inbox->count()  == 0)
                    <div style="text-align: center">Inbox empty</div>
                  @else

                    <!-- start Head of outbox table-->
                      <thead>
                        <tr>
                          <th>Subject</th>
                          <th class="all">Sender</th>
                          <th style="text-align: center" class="all">Action</th>
                          <th class="none"></th>
                        </tr>
                      </thead>
                    <!-- end Head of outbox table-->

                    <!-- start Body of inbox table-->
                      @include ('partials.inbox')
                    <!-- end Body of inbox table-->
                  @endif

                </table>
              </div>

            </div>
          <!--end show inbox mail-->

        </div>

      </div>
      <!-- end inbox management -->

    </div>
    <!-- end tab contents for inbox & outbox management -->

  </div>



@endsection
@section('footer')

<!-- js libraries -->
  <script src="{{URL::to('/')}}/js/charts.js"></script>
  <script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
  <!-- js libraries -->

<script type="text/javascript">
    check = 0;
    $('#in-tab').on('click', '#inbox-mail', function(){
      {
        id = $(this).attr('key');
        url = '{{url("inbox/mail/visit/update")}}/'+id;

        $.get(url);
      }

    });

    // start load the email of recipient on replying
    $('#inbox-mail').on('click', '#reply-modal-but', function(){
      form = $('#reply-form');

      form.find('input[name="eid"]').val($(this).attr('key'));
      form.find('input[name="rid"]').val($(this).attr('user'));
      form.find('#receiver').val($(this).attr('email'));
      form.find('input[name="body"]').val('');
      form.find('input[name="subject"]').val('');
      form.find('strong').html('');
    });
    // end load the email of recipient on replying


    $('#reply-form').submit(function(e){
      e.preventDefault();
      sub  = $(this).find('#subject');
      body = $(this).find('#body');

      $(this).find('strong').html('');

      if( sub.val() == '' )
      {
        sub.focus();
        $(this).find('#error-subject').html('Subject of the mail is necessary.');
      }
      else if( body.val() == '' )
      {
        body.focus();
        $(this).find('#error-body').html('Body of the mail is necessary.');
      }
      else
        this.submit();
    });



    // do stuff on page loading
    $(document).ready(function(){
      $('table').DataTable({'bInfo': false, 'aaSorting': []});
    });
    // do stuff on page loading

  $('#message-form').submit(function(e){
    e.preventDefault();

    sub  = $(this).find('#subject');
    body = $(this).find('#body');

    ch = false;
    $(this).find(':checkbox:checked').each(function(i){
      ch = true;
    });

    $(this).find('strong').html('');

    if( sub.val() == '' )
    {
      sub.focus();
      $(this).find('#error-subject').html('Subject of the mail is necessary.');
    }
    else if( body.val() == '' )
    {
      body.focus();
      $(this).find('#error-body').html('Body of the mail is necessary.');
    }
    else if(!ch)
      $(this).find('#error-receivers').html('Select atleast one member as recipient.');
    else
      this.submit();
  });


    $(document).ready(function(){

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

        $(this).next().slideToggle();
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
                  swal("Message sent")
            }
    });



    document.getElementById("message_form").reset();
      });
 });
        </script>

<!-- <script>
$(document).ready(function () {




  });

</script> -->
@endsection

