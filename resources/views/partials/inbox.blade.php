<table class="table table-striped mem-tab dt-responsive nowrap" id="in-tab" cellspacing="0" width="100%">

<!-- start Head of outbox table-->
  <thead>
    <tr>
      <th>Subject</th>
      <th class="all">Sender</th>
      <th style="text-align: center" class="all">Action</th>
      <th class="none" style="width: 1000px"></th>
    </tr>
  </thead>
<!-- end Head of outbox table-->


<!-- start Body of inbox table-->
@foreach( $inbox as $email )
  <tr>
    <td id="inbox-mail" key="{{$email['mid']}}">
      @if( $email['status'] == 'new' )
        <img src='{{url("img/mail.jpeg")}}' id="new-mail-{{$email['mid']}}">
      @endif
      {{$email['subject']}}
    </td>

    <td>
      @foreach( $email['musers'] as $muser )
        @if( $muser->users_id == $email['reply']->last()->sender_id )
          {{$muser->firstname}} {{$muser->lastname}}
          <php break; ?>
        @endif
      @endforeach
    </td>

    <td style="text-align: center">
      <img src="{{url('/')}}/img/reply.png" class="icon-style" key="{{$email['mid']}}" data-toggle="modal" data-target="#reply-mail" id='reply-modal-but' />
    </td>

    <td>
      <!-- start show all the mails -->
        <?php $i = 0; ?>
        @foreach($email['reply'] as $rep)
          <!-- start show sender image & detail -->
            @if( $i > 0 ) <hr> @endif
            <?php $i = 1; ?>
            <div>
              <!-- start show image -->

                <div style="display: inline-block;">
                  @foreach( $email['musers'] as $muser )
                    @if( $muser->users_id == $rep->sender_id )
                      <img src='{{url("/")}}{{$muser->avatar}}' style="width:50px; height:50px; border-radius: 50%;" />
                      <php break; ?>
                    @endif
                  @endforeach
                </div>

              <!-- end show image -->

              <!-- start show name & time of mail -->
                <div style="display: inline-block; margin-left: 10px">
                  <!-- start name of sender -->
                    @if( $rep->sender_id == Auth::user()->id )
                      you to
                      <B>
                        <?php $j = 0; ?>
                        @foreach( $email['musers'] as $muser )
                          @if( $muser->users_id != $rep->sender_id )
                            @if( $j > 0 ) , @endif
                            {{$muser->firstname}} {{$muser->lastname}}
                            <?php $j = 1; ?>
                          @endif
                        @endforeach
                      </B>
                    @else
                      @foreach( $email['musers'] as $muser )
                        @if( $muser->users_id == $rep->sender_id )
                          <B> {{$muser->firstname}} {{$muser->lastname}} </B>
                          <php break; ?>
                        @endif
                      @endforeach
                      &nbsp;to &nbsp;you
                      @if($email['musers']->count() > 2) ,&nbsp; @endif
                      <?php $k = 0; ?>
                      @foreach( $email['musers'] as $muser )
                        @if( $muser->users_id != $rep->sender_id && $muser->users_id != Auth::user()->id )
                          @if( $k > 0 ) , @endif
                          {{$muser->firstname}} {{$muser->lastname}}
                          <?php $k = 1; ?>
                        @endif
                      @endforeach
                    @endif
                  <!-- end name of sender -->

                  <!-- start time mail sended -->
                    <br/>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $rep->send_at)->format('D d, M Y') }}
                  <!-- end time mail sended -->
                </div>
              <!-- end show name & time of mail -->

            </div>
          <!-- end show sender image & detail -->

          <!-- start subject & body of tthe mail -->
            <div>

              <br/>

              <!-- start subject of the mail -->
                <B>Subject: {{$rep->subject}}</B>
              <!-- end subject of the mail -->

              <br/><br/>

              <!-- start body of the mail -->
                {{$rep->body}}
              <!-- end body of the mail -->

            </div>
          <!-- end subject & body of tthe mail -->

        @endforeach
      <!-- end show all the mails -->
      <div class="pull-right">
        <img src="{{url('/')}}/img/reply.png" class="icon-style" key="{{$email['mid']}}" data-toggle="modal" data-target="#reply-mail" id='reply-modal-but'/>
      </div>
    </td>
  </tr>
@endforeach
<!-- end Body of inbox table-->

</table>
