{!! csrf_field() !!}
          <input type="hidden" name="team_id" value="{{$id}}">
          <div class="form-group fg-line">
            <label for="label">Field name <small style="color: red">(required)</small></label>
            <input type="text" id="" class="form-control input-sm" name="field_name" autofocus>
          </div>

          <div class="form-group fg-line">
            <label for="label">Type</label> <small style="color: red">(required)</small></label>
            <select class="selectpicker show-menu-arrow" data-style="grey" name="field_type">
              <option value="text">Text</option>
              <option value="radio">Radio</option>
              <option value="checkbox">checkbox</option>
              <option value="select">Select</option>
            </select>
          </div>

          <div class="form-group fg-line" id="field-option" style="display: none">
            <h6 style="color: red">Use , to separate the options like a, b</h6>
            <label for="label">Options <small style="color: red">(required)</small></label>
            <textarea class="form-control" rows="5" name="field_options"></textarea>
          </div>
