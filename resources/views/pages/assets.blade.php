@extends('layouts.new', ['team' => $id, 'active' => 'assets'])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

  <style type="text/css">
    .tab-nav
    {
      box-shadow: inset 0 0px 0 0 #eeeeee;
    }
    .card .card-header:not(.ch-alt)
    {
      padding: 0px ;
    }
  </style>
@endsection

@section('content')

<div role="tabpanel">

  <!-- start tabs name for tracking & payment -->
  <ul class="tab-nav tab-nav" role="tablist" id="myTab">
    <li class="active"><a href="#payment-tab" role="tab" data-toggle="tab">Payment</a></li>
    <li role="presentation"><a href="#tracking-tab" role="tab" data-toggle="tab">Tracking</a></li>
  </ul>
  <!-- end tabs name for tracking & payment -->

  <!-- start tab contents for image management and videolink-file management -->
  <div class="tab-content">

    <!-- start payement info -->
    <div role="tabpanel" class="tab-pane active" id="payment-tab">

      <!-- start show manager privileges -->
        <div class="col-lg-12 col-xs-12 col-centered">
          <div class='well'>
            Manager:
            <button type="button" class="btn btn-success" style="margin-left: 5px; border-radius: 4px"  data-toggle="modal" href="#new-fee-modal">
              New Team Fee
            </button>
          </div>
        </div>
      <!-- end show manager privileges -->

      <!-- start show player & non player fee deatils -->
        <div class="col-lg-12 col-xs-12 col-centered" id="tables">
          <div class='well table-responsive'>

            <!-- start tab contents for player & staff fee details -->
              <div class="tab-content">

                <!-- start player fee detail -->
                <div role="tabpanel" class="tab-pane active" id="player-fee-tab">
                  @include ('partials.player-fee')
                </div>
                <!-- end player fee detail -->

              </div>
            <!-- end tab contents for player & staff fee details -->

          </div>
        </div>
      <!-- end show player & non player fee deatils -->

    </div>
    <!-- end payement info -->

    <!-- start tracking info -->
    <div role="tabpanel" class="tab-pane" id="tracking-tab">

      <!-- start show manager privileges -->
        <div class="col-lg-12 col-xs-12 col-centered">
          <div class='well'>
            Manager:
            <button type="button" class="btn btn-success" style="margin-left: 5px; border-radius: 4px" data-toggle="modal" href="#new-item-modal">
              Track New Item
            </button>
          </div>
        </div>
      <!-- end show manager privileges -->

      <!-- start show player & non player tracking deatils -->
        <div class="col-lg-12 col-xs-12 col-centered" id="tables">
          <div class='well table-responsive'>

            <!-- start tab contents for player & staff fee details -->
              <div class="tab-content">

                <!-- start player fee detail -->
                <div role="tabpanel" class="tab-pane active" id="player-tracking-tab">
                  @include ('partials.tracking')
                </div>
                <!-- end player fee detail -->

              </div>
            <!-- end tab contents for player & staff fee details -->

          </div>
        </div>
      <!-- end show player & non player tracking deatils -->

    </div>
    <!-- end tracking info -->

  </div>

</div>

<!-- start modal to create new team item -->
  <div class="modal fade" id="new-item-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
        </div>

        {{ Form::open(['method' => 'post', 'url' => $id.'/team/item', 'id' => 'team-item-form']) }}
          <div class="modal-body">

            <div class="col-sm-12">
              <div class="form-group col-sm-12">
                <input type="text" class="form-control input-sm" name="name" id="name" placeholder="Enter item name...">
                <strong id="error-name" class="strong-error"></strong>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-link">Save</button>
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
<!-- end modal to create new team item -->

<!-- start modal to manage team item -->
  <div class="modal fade" id="item-manage-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
        </div>

        <div class="modal-body" id='item-manage-body'>
          <input type="hidden" id="item_id">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="name">Item Name</label>
              <input type="text" class="form-control input-sm" name="name" id="name" placeholder="Enter item name..." readonly>
              <strong id="error-name" class="strong-error"></strong>
            </div>
          </div>

          <div class="col-sm-12">
            <button type="button" class="btn btn-info col-sm-5" id='item-edit-but'>Edit</button>
            <button type="button" class="btn btn-success col-sm-5" id='item-save-but' style="display: none">Save</button>
            <button type="button" class="btn btn-warning col-sm-5 pull-right" id='item-delete-but'>Delete</button>
            <button type="button" class="btn btn-info col-sm-5 pull-right" id='item-back-but' style="display: none">Back</button>
            <br><br><br>
            <button type="button" class="btn btn-default col-sm-12" data-dismiss="modal">Cancel</button>
          </div>

        </div>

        <div class="modal-footer">
        </div>

      </div>
    </div>
  </div>
<!-- end modal to manage team item -->


<!-- start modal to create new team fee -->
  <div class="modal fade" id="new-fee-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Fee</h4>
        </div>

        {{ Form::open(['method' => 'post', 'url' => $id.'/team/fee', 'id' => 'team-fee-form']) }}
          <div class="modal-body">


            <div class="col-sm-12">
              <div class="form-group col-sm-12">
                <label for="description">Fee Description</label>
                <input type="text" class="form-control input-sm" name="description" id="description" placeholder="description...">
                <strong id="error-description" class="strong-error"></strong>
              </div>

              <div class="form-group col-sm-12">
                <label for="amount">Fee Amount</label>
                  <input type="text" class="form-control input-sm" name="amount" id="amount" placeholder="amount...">
                  <strong id="error-amount" class="strong-error"></strong>
              </div>

              <div class="form-group col-sm-12">
                <label for="note">Notes</label>
                <textarea class="form-control" rows="4" id="note" name="note"></textarea>
              </div>
            </div>


          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-link">Save</button>
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
<!-- end modal to create new team fee -->

<!-- start modal to manage team item -->
  <div class="modal fade" id="fee-manage-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
        </div>

        {{ Form::open(['method' => 'post', 'url' => $id.'/fee/data/update', 'id' => 'fee-manage-body']) }}
        <div class="modal-body">
            <input type="hidden" id="fee_id" name="fee_id">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control input-sm" name="description" id="description" placeholder="Enter description..." readonly>
                <strong id="error-description" class="strong-error"></strong>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="amt">Amount (in $)</label>
                <input type="text" class="form-control input-sm" name="amount" id="amount" placeholder="Enter amount..." readonly>
                <strong id="error-amount" class="strong-error"></strong>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="name">Description</label>
                <textarea class="form-control" rows="4" id="note" name="note" readonly></textarea>
              </div>
            </div>
        </div>

        <div class="modal-footer">
          <div class="col-sm-12">
            <button type="button" class="btn btn-info" id='fee-edit-but'>Edit</button>
            <button type="button" class="btn btn-warning" id='fee-delete-but'>Delete</button>
            <button type="submit" class="btn btn-success" id='fee-save-but' style="display: none">Save</button>
            <button type="button" class="btn btn-info" id='fee-back-but' style="display: none">Back</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
        {{Form::close()}}

      </div>
    </div>
  </div>
<!-- end modal to manage team item -->

<!-- start modal to edit member team fee detail -->
  <div class="modal fade" id="user-fee-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" style="text-align: center" id="title"></h6>
        </div>
        <div class="modal-body" id='member-fee'>

            <input type="hidden" name="uid" value="">
            <input type="hidden" name="fid" value="">
            <input type="hidden" name="prev_amt" value="">
            <input type="hidden" name="type" value="">

            <div class="form-group col-sm-12">
              <label for="tranc-note">Transaction Note</label>
              <input type="text" id="f-ip" class="form-control input-sm" name="note" placeholder="Write note here...">
            </div>

            <div class="form-group col-sm-12">
              <a style="cursor: pointer" id="show-more">Show more details</a>
            </div>

            <div class="form-group col-sm-12" id='fee-options' style="display: none">
              <div class="radio m-b-15">
                <label>
                  <input type="radio" name="fee-check" value="1"><i class="input-helper"></i>Fee does not apply.
                </label>
              </div>

              <div class="radio m-b-15">
                <label>
                  <input type="radio" name="fee-check" value="2"><i class="input-helper"></i>Owes a different amount.
                </label>
              </div>

              <div class="form-group col-sm-12" style="display: none" id='amount-div'>
                <label for="amount">Enter amount (in $)</label>
                <input type="text" class="form-control input-sm" name="amount" placeholder="Amount...">
              </div>

              <div class="form-group col-sm-12">
                <strong id="error-all" class="strong-error"></strong>
              </div>

              <div class="form-group col-sm-12" style="margin-top: 8px;">
                <button type="button" class="btn btn-success col-sm-12" id="fee-option-button"> Save </button>
              </div>
            </div>

            <div class="form-group col-sm-12" id='paid-button-div' style="margin-top: 8px;">
              <button type="button" class="btn btn-success col-sm-12" id="paid-button"></button>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- end modal to edit member team fee detail -->

@endsection

@section('footer')

<script src="{{URL::to('/')}}/js/notify.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>

<script type="text/javascript">

    $('#fee-edit-but').click(function(){
      form = $('#fee-manage-body');
      form.find('input, textarea').removeAttr('readonly');
      form.find('#description').focus();
      toogleButtons($(this), $('#fee-delete-but'), $('#fee-save-but'), $('#fee-back-but'));
    });

    $('#fee-manage-body').submit(function(e){
      e.preventDefault();
      form = $('#fee-manage-body');
      desc = form.find('#description');
      amt  = form.find('#amount');
      id   = form.find('#fee_id');

      form.find('strong').html('');

      if( desc.val() == '' )
      {
        desc.focus();
        form.find('#error-description').html('Fee description required.');
      }
      else if( amt.val() == '' )
      {
        amt.focus();
        form.find('#error-amount').html('Fee amount required.');
      }
      else
      {
        this.submit();
      }
    });

    $('#fee-back-but').click(function(){
      resetFeeModal();
    });

    $('#payment-tab').on('click', '#fee-manage', function(){
      id  = $(this).attr('key');

      url = '{{url("get/fee/data")}}/'+id;

      $.post(url, function(fee){
        form = $('#fee-manage-body');
        form.find('#fee_id').val(id);
        form.find('#description').val(fee['description']);
        form.find('#amount').val(fee['amount']);
        form.find('#note').val(fee['note']);
        resetFeeModal();
      });
    });

    function resetFeeModal()
    {
      form = $('#fee-manage-body');
      form.find('input, textarea').attr('readonly', true);
      toogleButtons($('#fee-save-but'), $('#fee-back-but'), $('#fee-edit-but'), $('#fee-delete-but'));
    }

    // start show modal on clicking item name
      $('#tracking-tab').on('click', '#item-manage', function(){
        id = $(this).attr('key');

        form = $('#item-manage-body');
        form.find('#name').val($(this).html());
        form.find('#item_id').val(id);

        resetForm();
      });
    // end show modal on clicking item name

    // start event when item is deleted
      $('#item-delete-but').click(function(){
        id   = form.find('#item_id').val();
        window.location.href = "{{url($id.'/item/delete')}}/"+id;
      });
    // end event when item is deleted

    // start event when item name updated
      $('#item-save-but').click(function(){
        form = $('#item-manage-body');
        name = form.find('#name').val();
        id   = form.find('#item_id').val();

        form.find('#error-name').html('');

        if( name == '' )
          form.find('#error-name').html('Item name required.');
        else
          window.location.href = "{{url($id.'/item/update')}}/"+id+"/"+name;
      });
    // end event when item name updated

    // start event when item edit button clicked
      $('#item-edit-but').click(function(){
        toogleButtons($(this), $('#item-delete-but'), $('#item-save-but'), $('#item-back-but'));
        form = $('#item-manage-body');
        form.find('#name').removeAttr('readonly').focus();
      });
    // start event when item edit button clicked

    // start event when back button clicked
      $('#item-back-but').click(function(){
        resetForm();
      });
    // start event when back button clicked

    // start toggle the buttons in item manage modal
      function toogleButtons(a, b, c, d)
      {
        a.hide();
        b.hide();
        c.show();
        d.show();
      }
    // start toggle the buttons in item manage modal

    // start reset the form state
      function resetForm()
      {
        form = $('#item-manage-body');
        form.find('#name').attr('readonly', true);
        form.find('#error-name').html('');

        toogleButtons($('#item-save-but'), $('#item-back-but'), $('#item-edit-but'), $('#item-delete-but'));
      }
    // start reset the form state

    // start uodate the tracking info of an item & change item status in table
      $('#player-tracking-tab').find('input[type="checkbox"]').change(function(){
        tuser = $(this).attr('user-id');
        item  = $(this).attr('item-id');
        ptot  = parseInt($('#player-tracking-tab').find('#total'+item).html());

        ch    = ( $(this).prop('checked') ) ? 1 : 0;
        url   = '{{url("item/update")}}';

        $.post(url, {tuid: tuser, iid: item, ch: ch}, function(){
          notify('top', 'right', 'inverse', 'The item availability has been updated.');

          tot = (ch == 1) ? ptot + 1 : ptot - 1;
          $('#player-tracking-tab').find('#total'+item).html(tot);
        });
      });
    // end uodate the tracking info of an item & change item status in table

    // start validate & submit new team item form
      $('#team-item-form').submit(function(e){
        e.preventDefault();
        name = $(this).find('#name').val();
        $(this).find('#error-name').html('');

        if( name == '' )
          $(this).find('#error-name').html('Item name required.');
        else
          this.submit();
      });
    // start validate & submit new team item form

    // start reset member fee data maodal every time it is opened
      function resetModal(fee)
      {
        fee.find('#paid-button-div').show();
        fee.find('#fee-options').hide();
        fee.find('#amount-div').hide();
        fee.find('#show-more').html('Show more details');
        fee.find('input[name="amount"]').val('');
        fee.find('input[name="fee-check"]').removeAttr('checked');
        fee.find('#error-all').html('');
      }
    // end reset member fee data maodal every time it is opened

    // start when paid button is clicked update DB & table values
      $('#paid-button').click(function(){
        fee  = $('#member-fee');
        note = fee.find('input[name="note"]').val();
        uid  = fee.find('input[name="uid"]').val();
        fid  = fee.find('input[name="fid"]').val();
        pamt = fee.find('input[name="prev_amt"]').val();
        type = fee.find('input[name="type"]').val();

        url  = '{{url("member/fee/paid")}}';

        $.post(url, {note: note, uid: uid, fid: fid}, function(){

          changeTableData(type, uid, fid, pamt, pamt, 0);

          $('#amt'+fid+''+uid).html('paid');
          $('#amt'+fid+''+uid).css('color', 'green');
          $('#user-fee-details').modal('hide');
        });
      });
    // end when paid button is clicked update DB & table values

    // start when fee amt changed or member made n/a update DB & table values
      $('#fee-option-button').click(function(){
        ch   = $('input[name="fee-check"]:checked').val();

        fee  = $('#member-fee');

        note = fee.find('input[name="note"]').val();
        uid  = fee.find('input[name="uid"]').val();
        fid  = fee.find('input[name="fid"]').val();
        pamt = fee.find('input[name="prev_amt"]').val();
        type = fee.find('input[name="type"]').val();

        fee.find('#error-all').html('');

        // start if member does not have to pay
          if( ch == 1 )
          {
            url  = '{{url("member/fee/notapply")}}';

            $.post(url, {uid: uid, fid: fid, note: note}, function(){

              changeTableData(type, uid, fid, pamt, pamt, 0);

              $('#amt'+fid+''+uid).html('n/a');
              $('#amt'+fid+''+uid).css('color', 'grey');
              $('#user-fee-details').modal('hide');
            });
          }
        // end if member does not have to pay

        // start when fee amount changed
          else if( ch == 2 )
          {
            amt = fee.find('input[name="amount"]').val();

            if( amt == 0 )
              fee.find('#error-all').html('Please enter the amount.');
            else
            {
              url  = '{{url("member/fee/change")}}';

              $.post(url, {note: note, uid: uid, fid: fid, amt: amt}, function(){

                changeTableData(type, uid, fid, pamt, amt, 1);

                $('#amt'+fid+''+uid).html('$'+parseInt(amt).toFixed(2));
                $('#amt'+fid+''+uid).css('color', 'red');
                $('#user-fee-details').modal('hide');
              });
            }
          }
        // end when fee amount changed

        // start show error when no option selected
          else fee.find('#error-all').html('Select one of the option.');
        // end show error when no option selected
      });
    // end when fee amt changed or member made n/a update DB & table values

    // start change values in data table when a members fee detail is changed
      function changeTableData(type, uid, fid, pamt, amt, ch)
      {
        if( type == 'np' )
          tot = $('#nplayer'+uid).html();
        else
          tot = $('#player'+uid).html();

        tot  = parseFloat(tot.substr(1));
        pamt = parseFloat(pamt);
        amt  = parseFloat(amt);

        // start change in total player balance in table
          res  = (ch == 1) ? tot - pamt + amt : tot - pamt;

          if( type == 'np' )
            $('#nplayer'+uid).html('$'+res);
          else
            $('#player'+uid).html('$'+res);
        // end change in total player balance in table

        // start show change in total team balance & fee balance
          @if( $staffs->count() == 0 )
          {
            pttot = $('#pteam-total');
            pfee  = $('#pfee'+fid);
          }
          @else
          {
            pttot = $('#npteam-total');
            pfee  = $('#npfee'+fid);
          }
          @endif

          ttot  = pttot.html();
          ttot  = parseFloat(ttot.substr(1));

          res  = (ch == 1) ? ttot - pamt + amt : ttot - pamt;

          pttot.html('$'+res);

          ftot  = pfee.html();
          ftot  = parseFloat(ftot.substr(1));

          res  = (ch == 1) ? ftot - pamt + amt : ftot - pamt;

          pfee.html('$'+res);
        // end show change in total team balance & fee balance
      }
    // end change values in data table when a members fee detail is changed

    // start show not applicable & change amount options on clicking
      $('#show-more').click(function(){
        $('#fee-options').toggle();
        $('#paid-button-div').toggle();
        if( $(this).html() == 'Hide details' )
          $(this).html('Show more details');
        else
          $(this).html('Hide details');
      });
    // end show not applicable & change amount options on clicking

    // start show & hide new amount input
      $('input[name="fee-check"]').change(function(){
        div = $('#amount-div');
        if( $(this).val() == 2 )
          div.show();
        else
          div.hide();
      });
    // end show & hide new amount input

    // start event on clicking edit the fee details of a member
      $('#tables').on('click', '#edit', function(){
        fid    = $(this).attr('fee-id');
        name   = $(this).attr('uname');
        uid    = $(this).attr('uid');
        type   = $(this).attr('type');
        if( type == 'np' )
          amt    = $('#np-table').find('#amt'+fid+''+uid).html();
        else
          amt    = $('#p-table').find('#amt'+fid+''+uid).html();

        resetModal($('#member-fee'));

        $('#member-fee').find('input[name="uid"]').val(uid);
        $('#member-fee').find('input[name="fid"]').val(fid);
        $('#member-fee').find('input[name="type"]').val(type);
        $('#paid-button').removeAttr('disabled');
        amt = amt.trim();

        url = '{{url("get/fee/data")}}/'+fid;
        $.post(url, function(fee){
          if( amt == 'n/a' )
            $('#paid-button').attr('disabled', 'disabled');
          if( amt == 'paid' || amt == 'n/a' )
            amt = '$0.00';

          $('#member-fee').find('input[name="prev_amt"]').val(amt.substr(1));

          $('#title').html(name+"'s payment detail for "+fee['description']+'<br>Owes '+amt);

          $('#paid-button').html('Paid '+amt);
        });
      });
    // end event on clicking edit the fee details of a member

    // start load Data Table on page load
      $(document).ready(function(){
        $('table').DataTable({'bLengthChange': false, 'bInfo': false, "bPaginate": false, "scrollY": "400px", "scrollCollapse": true, "scrollX": true});
      });
    // end load Data Table on page load

    // start validate new team fee
      $("#team-fee-form").submit(function(e){
        e.preventDefault();

        desc = $(this).find('#description');
        amt  = $(this).find('#amount');
        dec  = /^\d+\.\d{2,2}$/;
        int  = /[0-9]/;

        $(this).find('strong').html('');

        if( desc.val() == '' ){
          desc.focus();
          $(this).find('#error-description').html('Description of fee is necessay.');
        }
        else if( amt.val() == '' || isNaN(amt.val()) || amt.val().split('.')[1] == '' )
        {
          amt.focus();
          $(this).find('#error-amount').html('Fee amount is necessay.');
        }
        else
          this.submit();
      });
    // end validate new team fee
</script>

@endsection
