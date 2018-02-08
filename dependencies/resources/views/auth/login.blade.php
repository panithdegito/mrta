@extends('layouts.login')

@section('right-container')
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{asset('/admin-assets/images/logo.svg')}}" alt="MRTA ORANGE LINE" data-src="{{asset('/admin-assets/images/logo.svg')}}" data-src-retina="{{asset('/admin-assets/images/logo.svg')}}" height="30">
           <!-- <h1>Hotel</h1>-->
            <p class="p-t-35">ลงชื่อเข้าสู่ระบบ</p>
            <!-- START Login Form -->
            <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>

                @if ($errors->has('password') or $errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        @if($errors->has('email'))
                            ป้อนอีเมลในรูปแบบ someone@example.com<br>
                            @endif
                        @if($errors->has('password'))
                            จำเป็นต้องระบุรหัสผ่าน
                            @endif
                    </div>

                @endif
                {{ csrf_field() }}
                <div class="form-group form-group-default{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>อีเมล</label>
                    <div class="controls">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group form-group-default{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label>รหัสผ่าน</label>
                    <div class="controls">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>


                    <div class="row">
                        <div class="col-md-6 no-padding sm-p-l-10">
                            <div class="checkbox ">
                                <input type="checkbox" name="remember" id="checkbox1" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox1">จดจำฉัน</label>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-end">
                            <a href="{{ route('password.request') }}" class="small">ลืมรหัสผ่าน ?</a>
                        </div>
                    </div>
                    <!-- END Form Control-->
                    <button class="btn-lg btn-block btn-primary btn-hotel btn-primary-hotel btn-cons m-t-10" type="submit">เข้าสู่ระบบ</button>


            </form>
            <!--END Login Form-->
            <div class="pull-bottom sm-pull-bottom">
                <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">

                    <div class="col-sm-12 no-padding m-t-10">
                        <p>
                            <small>
                                สงวนลิขสิทธิ์ © 2018 การรถไฟฟ้าขนส่งมวลชนแห่งประเทศไทย<br>ออกแบบและพัฒนาโดย <a href="https://www.degitobangkok.com">DEGITO</a></p>

                        </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
