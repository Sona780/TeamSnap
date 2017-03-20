@extends('layouts.app')

@section('content')
<div class="block-header">
    <h2 style="text-transform: uppercase">{{$user['detail']->firstname}} {{$user['detail']->lastname}}</h2>
</div>
<div class="card" id="profile-main">
    <!-- side image & contact detail -->
    <div class="pm-overview c-overflow">
        <div class="pmo-pic">
            <div class="p-relative">
                <a href="">
                    <img class="img-responsive" src="{{url($user['detail']->avatar)}}" alt="">
                </a>
                <a href="" class="pmop-edit">
                    <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">Update Profile Picture</span>
                </a>
            </div>
        </div>

        <div class="pmo-block pmo-contact hidden-xs">
            <h2>Contact</h2>

            <ul>
                <li id="side-phone"><i class="zmdi zmdi-phone"></i> {{$user['detail']->mobile}}</li>
                <li><i class="zmdi zmdi-email"></i> {{$user['mail']}}</li>
                <li>
                    <i class="zmdi zmdi-pin"></i>
                    <address class="m-b-0 ng-binding">
                        {{$user['detail']->city}}, {{$user['detail']->state}}
                    </address>
                </li>
            </ul>
        </div>
    </div>
    <!-- side image & contact detail -->

    <!-- start about tab -->
    <div class="pm-body clearfix">
        <!-- different tabs -->
        <ul class="tab-nav tn-justified">
            <li class="active waves-effect"><a href="profile-about.html">About</a></li>
        </ul>
        <!-- different tabs -->


        <!-- start basic info -->
        <div class="pmb-block"  id="basic-info-blk">
            <!-- start header of basic info -->
            <div class="pmbb-header">
                <h2><i class="zmdi zmdi-account m-r-5"></i> Basic Information</h2>

                <ul class="actions">
                    <li class="dropdown">
                        <!-- start show dots -->
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
                        <!-- end show dots -->

                        <!-- start show edit option -->
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a data-pmb-action="edit" id="basic-edit" href="">Edit</a></li>
                        </ul>
                        <!-- stop show edit option -->
                    </li>
                </ul>
            </div>
            <!-- end header of basic info -->

            <!-- start detail of basic info -->
            <div class="pmbb-body p-l-30">
                <!-- start show details -->
                    <div class="pmbb-view">
                        <dl class="dl-horizontal">
                            <dt>Full Name</dt>
                            <dd id="show-name">{{$user['detail']->firstname}} {{$user['detail']->lastname}}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Gender</dt>
                            <dd id="show-gender" key="{{$user['detail']->gender}}">
                                @if( $user['detail']->gender == 0 ) Male @else Female @endif
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Birthday</dt>
                            <dd id="show-birthday" key="{{$user['detail']->birthday}}">
                                @if( $user['detail']->birthday != '' )
                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $user['detail']->birthday)->format('M d, Y') }}
                                @endif
                            </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Age</dt>
                            <dd id="show-age">
                                @if( $user['detail']->birthday != '' )
                                    {{ \Carbon\Carbon::createFromFormat('d/m/Y', $user['detail']->birthday)->diff(\Carbon\Carbon::now())->
                                    format('%y years') }}
                                @endif
                            </dd>
                        </dl>
                    </div>
                <!-- end show details -->

                <!-- start edit basic info -->
                    {{ Form::open(['method' => 'post', 'id' => 'basic-form']) }}
                        {!! csrf_field() !!}
                        <div class="pmbb-edit">
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">First Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" id="fname" name="fname">
                                    </div>
                                    <strong id="error-fname" style="color: red"></strong>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Last Name</dt>
                                <dd>
                                    <div class="fg-line">
                                        <input type="text" class="form-control" id="lname" name="lname">
                                    </div>
                                    <strong id="error-lname" style="color: red"></strong>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Gender</dt>
                                <dd>
                                    <div class="fg-line">
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="0">Male</option>
                                            <option value="1">Female</option>
                                        </select>
                                    </div>
                                </dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt class="p-t-10">Birthday</dt>
                                <dd>
                                    <div class="dtp-container dropdown fg-line">
                                        <input type='text' class="form-control date-picker" id="birthday" name="birthday" data-toggle="dropdown">
                                    </div>
                                    <strong id="error-birthday" style="color: red"></strong>
                                </dd>
                            </dl>


                            <div class="m-t-30">
                                <button class="btn btn-primary btn-sm">Save</button>
                                <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button>
                            </div>
                        </div>
                    {{Form::close()}}
                <!-- end edit basic info -->
            </div>
            <!-- start detail of basic info -->

        </div>
        <!-- start basic info -->


        <!-- start contact info -->
        <div class="pmb-block" id="contact-info-blk">
            <!-- head of contact info -->
                <div class="pmbb-header">
                    <h2><i class="zmdi zmdi-phone m-r-5"></i> Contact Information</h2>

                    <ul class="actions">
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a data-pmb-action="edit" href="" id="contact-edit">Edit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <!-- head of contact info -->

            <!-- start contact details -->
                <div class="pmbb-body p-l-30">
                    <!-- start show contact info -->
                        <div class="pmbb-view">
                            <dl class="dl-horizontal">
                                <dt>Mobile Phone</dt>
                                <dd id='show-phone'>{{$user['detail']->mobile}}</dd>
                            </dl>
                            <dl class="dl-horizontal">
                                <dt>Email Address</dt>
                                <dd>{{$user['mail']}}</dd>
                            </dl>
                        </div>
                    <!-- end show contact info -->

                    <!-- start edit contact info -->
                        {{ Form::open(['method' => 'post', 'id' => 'contact-form']) }}

                            {!! csrf_field() !!}
                            <div class="pmbb-edit">
                                <dl class="dl-horizontal">
                                    <dt class="p-t-10">Mobile Phone</dt>
                                    <dd>
                                        <div class="fg-line">
                                            <input type="text" name='phone' class="form-control" id="phone">
                                        </div>
                                        <strong id="error-phone" style="color: red"></strong>
                                    </dd>
                                </dl>

                                <div class="m-t-30">
                                    <button class="btn btn-primary btn-sm">Save</button>
                                    <button data-pmb-action="reset" class="btn btn-link btn-sm">Cancel</button>
                                </div>
                            </div>

                        {{Form::close()}}
                    <!-- end cedit contact info -->
                </div>
            <!-- end contact details -->
        </div>
        <!-- end contact info -->

    </div>
    <!-- end about tab -->

</div>
@endsection


@section('footer')
    <script src="{{URL::to('/')}}/js/notify.js"></script>

    <script type="text/javascript">

        // start js related to contact info
            // start populate edit contact form with DB values
            $('#contact-edit').click(function(){
                $('#phone').val($('#show-phone').html());

                $('#contact-form').find('strong').html('');
            });
            // start populate edit contact form with DB values


            // start validate & update contact info
            $('#contact-form').submit(function(e){
                e.preventDefault();
                phone = $(this).find('input[name="phone"]').val();

                reg = /[0-9]/;

                if( phone == '' || !phone.match(reg) || phone.length != 10 )
                    $('#error-phone').html('Please enter a valid phone number.');
                else
                {
                    $('#error-phone').html('');
                    p = $('#phone').val();
                    $('#show-phone').html(p);
                    $('#side-phone').html('<i class="zmdi zmdi-phone"></i>'+p);
                    $('#contact-info-blk').removeClass('toggled');

                    detail = $('#contact-form').serializeArray();
                    url    = '{{url("update/contact")}}';

                    $.post(url, detail, function(){
                        notify('top', 'right', 'inverse', 'Your contact details has been updated successfully.');
                    });
                }
            });
            // end validate & update contact info
        // end js related to contact info

        // start js related to basic info
            // start populate edit basic form with DB values
            $('#basic-edit').click(function(){
                temp  = $('#show-name').html();
                lname = (temp.substr(temp.indexOf(' '))).trim();
                fname = temp.split(' ')[0];

                $('#fname').val(fname);
                $('#lname').val(lname);
                $('#gender option[value="'+ $('#show-gender').attr('key') +'"]').prop('selected', true);
                $('#birthday').val($('#show-birthday').attr('key'));

                $('#basic-form').find('strong').html('');
            });
            // start populate edit basic form with DB values


            // start validate & update basic info
            $('#basic-form').submit(function(e){
                e.preventDefault();

                fname = $('#fname').val();
                lname = $('#lname').val();
                birth = $('#birthday').val();
                //alert(birth);

                $(this).find('strong').html('');

                if( fname == '' )
                    $('#error-fname').html('First name required.');
                else if( lname == '' )
                    $('#error-lname').html('Last name required.');
                else if( birth == '' )
                    $('#error-birthday').html('Date of birth required.');
                else
                {
                    gen = ($('#gender').val() == 0) ? 'Male' : 'Female';
                    dob  = birth.split('/')[2];
                    curr = (new Date()).getFullYear();
                    age  = parseInt(curr) - parseInt(dob);


                    $('#show-name').html(fname +" "+ lname);
                    $('#show-gender').attr('key', $('#gender').val()).html(gen);
                    $('#show-age').html(age+" years");

                    $('#basic-info-blk').removeClass('toggled');

                    detail = $('#basic-form').serializeArray();
                    url    = '{{url("update/profile")}}';

                    $.post(url, detail, function(birth){
                        $('#show-birthday').html(birth);
                        notify('top', 'right', 'inverse', 'Your contact details has been updated successfully.');
                    });
                }
            });
            // end validate & update basic info
        // end js related to basic info

    </script>

@endsection