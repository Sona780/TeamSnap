<!-- start new announcement modal -->
<div id="announcement-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">New Announcement</h4>
        <h5 style="text-align: center; color:red" id="error-ann"></h5>
      </div>
      <!-- Modal header -->
      {{ Form::open(['method' => 'post', 'id' => 'announcement-form']) }}
          @include('partials.announcement', ['save' => 'submit-announcement'])
      {{Form::close()}}
    </div>
  </div>
</div>
<!-- end new announcement modal -->

<!-- start edit announcement modal -->
<div id="edit-ann" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">Edit Announcement</h4>
        <h5 style="text-align: center; color:red" id="error-ann"></h5>
      </div>
      <!-- Modal header -->
      {{ Form::open(['method' => 'post', 'id' => 'edit-ann-form']) }}
          <input type="hidden" name="id" id="id">
          @include('partials.announcement', ['save' => 'edit-sub-announcement'])
      {{Form::close()}}
    </div>
  </div>
</div>
<!-- end edit announcement modal -->
