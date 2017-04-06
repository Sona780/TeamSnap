@extends('layouts.app')


@section('content')

<div class="container content">
 



   <div class="fileinput fileinput-new" data-provides="fileinput" id="file-field">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="padding:0px 0px">
                    </div>
                    <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new">Select image</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="file">
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" style="width: 99px" data-dismiss="fileinput" id="remove_img">Remove</a>
                    </div>
                </div>

</div>


@endsection
