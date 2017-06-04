@if(Session::has('success'))
  <br>
  <div class="alert alert-success alert-dismissable" id='alert'>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{ Session::get('success') }}</strong>
  </div>
@endif
@if(Session::has('error'))
  <br>
  <div class="alert alert-danger alert-dismissable" id='alert-danger'>
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{ Session::get('error') }}</strong>
  </div>
@endif
