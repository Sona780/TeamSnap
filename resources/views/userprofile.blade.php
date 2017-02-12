@extends('layouts.new')


@section('content')

<div class="card">
 
<h2>Member Profile for Kaushal Pandey</h2>
    <div class="row">
			<div class="col-sm-3">
				<img src ="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius: 50%; margin-right: 25px;" />

                <form enctype="multipart/form-data" action ="/{{ $user->id }}/userprofile" method="POST">
                 {!! csrf_field() !!}
                <label> Update Profile Picture</label>
                <input type="file" name="avatar">

                <input type="submit" class="pull-right">
                </form>

            </div>

			<div class="col-sm-9">

                  <div class="card">
                        <div>
                            <p>Kaushal Pandey</p>



                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <tbody>

                                    <tr>
                                        <td>Name</td>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>



			</div>


 	    </div>





@endsection
