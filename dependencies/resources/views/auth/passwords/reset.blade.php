@extends('layouts.login')

@section('right-container')
    <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
            <img src="{{asset('/admin-assets/images/logo.svg')}}" alt="MRTA ORANGE LINE" data-src="{{asset('/admin-assets/images/logo.svg')}}" data-src-retina="{{asset('/admin-assets/images/logo.svg')}}" height="30">
            <p class="p-t-35">ตั้งรหัสผ่านใหม่</p>
            <!-- START Login Form -->
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}" novalidate>

                @if ($errors->has('password') or $errors->has('email') or $errors->has('password_confirmation'))
                    <div class="alert alert-danger" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        @if($errors->has('email'))
                            ป้อนอีเมลในรูปแบบ someone@example.com<br>
                        @endif
                        @if($errors->has('password'))
                            จำเป็นต้องระบุรหัสผ่านใหม่<br>
                        @endif
                        @if($errors->has('password'))
                            จำเป็นต้องยืนยันรหัสผ่านใหม่
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
                    <label>รหัสผ่านใหม่</label>
                    <div class="controls">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>
                    <div class="form-group form-group-default{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label>ยืนยันรหัสผ่าน</label>
                        <div class="controls">
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>


                    <div class="row"  style="margin-top: 15px">

                        <a href="{{ route('login') }}" class="small">กลับไปหน้าเข้าสู่ระบบ</a>


                    </div>
                <!-- END Form Control-->
                <button class="btn-lg btn-block btn-primary btn-hotel btn-primary-hotel btn-cons m-t-10" type="submit">รีเซ็ทรหัสผ่าน</button>


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
