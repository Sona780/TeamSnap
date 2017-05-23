<div class="listview" id='all-announcements'>

          <ul class='li-class' id="example2">
            @foreach($announcements as $a)
              <li id="li{{$a->id}}">
                <a class="lv-item" style="background: white">
                  <div class="media">
                    <div class="media-body">
                      <div class="lv-title" style="text-transform: uppercase" id="heading">
                        {{$a->title}}
                      </div>
                      <p style="color: grey" id="detail">{{$a->announcement}}</p>
                    </div>
                  </div>
                  <div class="pull-left" id="dates">
                    {{$a->start}} to {{$a->end}}
                  </div>
                  @if( $access != 0 )
                  <div class="pull-right">
                    <button class="btn btn-success" type="button" id="edit" key="{{$a->id}}" data-toggle="modal" data-target="#edit-ann">Edit</button>
                    <button class="btn btn-danger" type="button" key="{{$a->id}}" id="delete">Delete</button>
                  </div>
                  @endif
                </a>
              </li>
            @endforeach
          </ul>

          <div class="lv-footer" style="margin-top: 8%">
            <div id="example2-pagination">
              <a id="example2-previous" href="#">&laquo; Previous</a>
              <a id="example2-next" href="#">Next &raquo;</a>
            </div>
          </div>

        </div>
