@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="active">
                        <a href="{{route('users.index')}}">จัดการบัญชีผู้ใช้</a>
                    </li>

                    <li>
                        <a href="{{route('roles.index')}}"><span class="title">สิทธิ์การเข้าถึง</span></a>
                    </li>

                    <li>
                        <a href="{{route('generals.index')}}"><span class="title">ข้อมูลทั่วไป</span></a>
                    </li>

                    <li>
                        <a href="{{route('email.index')}}"><span class="title">อีเมลระบบ</span></a>
                    </li>
                    <li>
                        <a href="{{route('statuses.index')}}"><span class="title">สถานะเริ่มต้น</span></a>
                    </li>


                    <li>
                        <a href="{{route('languages.index')}}"><span class="title">ภาษา</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">ตั้งค่า</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">จัดการบัญชีผู้ใช้</a></li>
                <li class="breadcrumb-item active">แก้ไข {{$user->name}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>แก้ไข {{$user->name}}

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
                                    @if($errors->has('name')) จำเป็นต้องระบุชื่อ<br>@endif
                                    @if($errors->has('email')) ป้อนอีเมลในรูปแบบ someone@example.com<br>@endif
                                    @if($errors->has('password')) จำเป็นต้องระบุรหัสผ่าน<br>@endif
                                    @if($errors->has('password_confirmation')) จำเป็นต้องยืนยันรหัสผ่าน<br>@endif
                                    @if($errors->has('roles')) จำเป็นต้องระบุสิทธิ์การเข้าถึง<br>@endif

                                </div>

                            @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'id' => 'form-work', 'class' => 'form-horizontal', 'role'=>'form', 'autocomplete'=>'off','novalidate'=>'novalidate')) }}{{-- Form model binding to automatically populate our fields with user data --}}
                            {{csrf_field()}}
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="name" placeholder="สมชาข รักโลก" name="name"  value="{{old('name', $user->name)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">อีเมล *</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control error" id="email" placeholder="someone@example.com" name="email"  value="{{old('email', $user->email)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">รหัสผ่าน *</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control error" id="password" name="password"  value="{{old('password')}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ยืนยันรหัสผ่าน *</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control error" id="password_confirmation" name="password_confirmation"  value="" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                @if(!$roles->isEmpty())

                                    <label class="col-md-3 control-label">กำหนดสิทธิ์การเข้าถึง *</label>
                                    <div class="col-md-9">
                                        @foreach ($roles as $role)
                                            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">
                                    <a href="{{route('users.index')}}" class="btn btn-hotel btn-primary-hotel">กลับ</a>
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