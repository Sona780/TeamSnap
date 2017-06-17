{!! csrf_field() !!}
<div class="modal-body">

  <div class="form-group fg-line">
    <label for="firstname">First name <small style="color: red">(required)</small></label>
    {{Form::text('firstname', null, ['class' => 'form-control', 'autofocus' => true])}}
  </div>

  <div class="form-group fg-line">
    <label for="lastname">Last name <small style="color: red">(required)</small></label>
    {{Form::text('lastname', null, ['class' => 'form-control'])}}
  </div>

  <div class="form-group fg-line">
    <label for="email">Email <small style="color: red">(required)</small></label>
    {{Form::email('email', null, ['class' => 'form-control'])}}
  </div>

  <div class="form-group fg-line">
    <label for="mobile">Contact number</label>
    {{Form::text('mobile', null, ['class' => 'form-control'])}}
  </div>

</div>

<div class="modal-footer">
  <button type="submit" class="btn btn-info">{{$submitButton}}</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
