<table class="table table-striped mem-tab dt-responsive nowrap" style="width:100% !important">

  <!-- start Head of outbox table-->
    <thead>
      <tr>
        <th class="all">Subject</th>
        <th class="all">Recipient(s)</th>
        <th>Send at</th>
        <th class="none"></th>
      </tr>
    </thead>
  <!-- end Head of outbox table-->

  <!-- start Body of outbox table-->
    @foreach( $outbox as $out )
      <tr>
        <td> {{$out->subject}} </td>
        <td>
          <?php $cnt = 0; ?>
          @foreach( $recipients[$out->emails_id] as $r )
            @if( $cnt > 0 ) ,&nbsp;&nbsp; @endif
            {{$r->firstname}} {{$r->lastname}}
            <?php $cnt = 1; ?>
          @endforeach
        </td>
        <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $out->send_at)->format('D d, M Y') }} </td>
        <td>

          <!-- start show sender image & detail -->
            <div>
              <!-- start show image -->
                <div style="display: inline-block;">
                  <img src='{{url("/")}}{{$avatar}}' style="width:50px; height:50px; border-radius: 50%;" />
                </div>
              <!-- end show image -->

              <!-- start show name & time of mail -->
                <div style="display: inline-block; margin-left: 10px">
                  <!-- start name of sender -->
                    you to <B>
                    <?php $cnt = 0; ?>
                    @foreach( $recipients[$out->emails_id] as $r )
                    @if( $cnt > 0 ) ,&nbsp;&nbsp; @endif
                      {{$r->email}}
                      <?php $cnt = 1; ?>
                    @endforeach
                    </B>
                  <!-- end name of sender -->

                  <!-- start time mail sended -->
                    <br/>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $out->send_at)->format('D d, M Y') }}
                  <!-- end time mail sended -->
                </div>
              <!-- end show name & time of mail -->

            </div>
          <!-- end show sender image & detail -->

          <!-- start subject & body of tthe mail -->
            <div>

              <br/>

              <!-- start subject of the mail -->
                <B>Subject: {{$out->subject}}</B>
              <!-- end subject of the mail -->

              <br/><br/>

              <!-- start body of the mail -->
                {{$out->body}}
              <!-- end body of the mail -->

            </div>
          <!-- end subject & body of tthe mail -->

        </td>
      </tr>
    @endforeach
  <!-- end Body of outbox table-->

</table>
