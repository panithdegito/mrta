@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li>
                        <a href="{{route('users.index')}}">จัดการบัญชีผู้ใช้</a>
                    </li>

                    <li>
                        <a href="{{route('roles.index')}}"><span class="title">สิทธิ์การเข้าถึง</span></a>
                    </li>

                    <li>
                        <a href="{{route('generals.index')}}"><span class="title">ข้อมูลทั่วไป</span></a>
                    </li>

                    <li class="active">
                        <a href="{{route('email.index')}}"><span class="title">อีเมลระบบ</span></a>
                    </li>

                    <li>
                        <a href="{{route('statuses.index')}}"><span class="title">สถานะเริ่มต้น</span></a>
                    </li>


                    <li>
                        <a href="{{route('languages.index')}}"><span class="title">ภาษา</span></a>
                    </li>

                </ul> </div>
        </div>
    </div>
@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="/admin/dashboard">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">ตั้งค่า</a></li>
                <li class="breadcrumb-item active">อีเมลระบบ</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>อีเมลระบบ

                </h1>

            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class=" container    container-fixed-lg">
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <div class="card card-transparent">
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                {!! Session('flash_message') !!}
                            </div>

                        @endif
                        @if (sizeof($errors) != 0)
                            <div class="alert alert-danger" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                @if($errors->has('receiver_email')){{ $errors->first('receiver_email') }}<br>@endif
                                @if($errors->has('receiver_name')){{ $errors->first('receiver_name') }}<br>@endif
                                @if($errors->has('sender_host')){{ $errors->first('sender_host') }}<br>@endif
                                @if($errors->has('sender_port')){{ $errors->first('sender_port') }}<br>@endif
                                @if($errors->has('sender_username')){{ $errors->first('sender_username') }}<br>@endif
                                @if($errors->has('sender_password')){{ $errors->first('sender_password') }}<br>@endif
                                @if($errors->has('sender_encryption')){{ $errors->first('sender_encryption') }}<br>@endif
                                @if($errors->has('sender_name')){{ $errors->first('sender_name') }}<br>@endif



                            </div>

                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        {{ Form::model($email, array('route' => array('email.update', $email->id), 'method' => 'PUT', 'id' => 'form-work', 'class' => 'form-horizontal', 'role'=>'form', 'autocomplete'=>'off','novalidate'=>'novalidate')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
                            <h3>อีเมลรับเข้า</h3>
                        <div class="form-group row{{ $errors->has('receiver_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">ชื่อ *</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control error" id="receiver_name" placeholder="การรถไฟฟ้าแห่งประเทศไทย" name="receiver_name"  value="{{old('receiver_name',$email->receiver_name)}}" required="" aria-required="true" aria-invalid="true">
                            </div>
                        </div>
                            <div class="form-group row{{ $errors->has('receiver_email') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">อีเมล *</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control error" id="receiver_email" placeholder="someone@example.com" name="receiver_email"  value="{{old('receiver_email',$email->receiver_email)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <h3>อีเมลส่งออก</h3>
                            <div class="form-group row{{ $errors->has('sender_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="sender_name" placeholder="การรถไฟฟ้าแห่งประเทศไทย" name="sender_name"  value="{{old('sender_name',$email->sender_name)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('sender_host') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">โฮส *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="sender_host" placeholder="smtp.mailtrap.io" name="sender_host"  value="{{old('sender_host',$email->sender_host)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('sender_port') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">พอร์ต *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="sender_port" placeholder="25" name="sender_port"  value="{{old('sender_port',$email->sender_port)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('sender_username') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อผู้ใช้งาน / อีเมล *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="sender_username" placeholder="somename" name="sender_username"  value="{{old('sender_username',$email->sender_username)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('sender_password') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">รหัสผ่าน *</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control error" id="sender_password" placeholder="" name="sender_password"  value="{{old('sender_password',$email->sender_password)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('sender_encryption') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">การเข้ารหัส *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="sender_encryption" placeholder="tls or ssl or null" name="sender_encryption"  value="{{old('sender_encryption',$email->sender_encryption)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>




                            <div class="row" style="padding-top: 10px">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-9">
                                <button class="btn btn-hotel btn-sec-hotel" type="submit">บันทึก</button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>



        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
@endsection





