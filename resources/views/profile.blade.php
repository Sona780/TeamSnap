@extends('layouts.new')


@section('content')

<div class="container">
 <h2>Member Profile for Kaushal Pandey</h2>
	<div class="card">
    <a href="/{{$id->id}}/profiel/edit"> Edit </a> 
 	    <div class="row">
			<div class="col-sm-3">
				<img src ="/uploads/avatars/{{ $avatar->avatar }}" style="width:150px; height:150px; float:left; border-radius: 50%; margin-right: 25px;" />

                <form enctype="multipart/form-data" action ="/{{ $id->id }}/profile" method="POST">
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
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>Alexandra</td>

                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>Alexandra</td>

                                    </tr>
                                    <tr>
                                        <td>Jersy Number</td>
                                        <td>Alexandra</td>

                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>Alexandra</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>



			</div>


 	    </div>
	</div>



@endsection
