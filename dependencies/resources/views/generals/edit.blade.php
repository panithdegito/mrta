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

                    <li class="active">
                        <a href="javascript:;"><span class="title">ข้อมูลทั่วไป</span></a>
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
                <li class="breadcrumb-item active">ข้อมูลทั่วไป</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>ข้อมูลทั่วไป

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
                                @foreach($languages as $language)
                                    @if($errors->has('title'.$language->abbreviation)){{ $errors->first('title'.$language->abbreviation) }}<br>@endif
                                        @if($errors->has('description'.$language->abbreviation)){{ $errors->first('description'.$language->abbreviation) }}<br>@endif
                                        @if($errors->has('keyword'.$language->abbreviation)){{ $errors->first('keyword'.$language->abbreviation) }}@endif
                                @endforeach



                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        <form method="POST" action="{{route('generals.update',$general->id)}}" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                            <input name="_method" type="hidden" value="PUT">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อหัวเว็บ *</label>
                                <div class="col-md-9">
                                    <div class="card card-transparent">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-linetriangle hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <li class="nav-item">
                                                        <a href="#" class="active" data-toggle="tab" data-target="#{{$language->abbreviation}}" aria-expanded="true"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a href="#" data-toggle="tab" data-target="#{{$language->abbreviation}}" class="" aria-expanded="false"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <div class="tab-pane fade active show" id="{{$language->abbreviation}}" aria-expanded="true">
                                                        <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation,$general->translate($language->abbreviation)->title)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                        <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation,$general->translate($language->abbreviation)->title)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">คำอธิบาย (meta description) *</label>
                                <div class="col-md-9">
                                    <div class="card card-transparent">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-linetriangle hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <li class="nav-item">
                                                        <a href="#" class="active" data-toggle="tab" data-target="#des{{$language->abbreviation}}" aria-expanded="true"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a href="#" data-toggle="tab" data-target="#des{{$language->abbreviation}}" class="" aria-expanded="false"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <div class="tab-pane fade active show" id="des{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" id="description{{$language->abbreviation}}" placeholder="" name="description{{$language->abbreviation}}"   required="" aria-required="true" aria-invalid="true">{{old('description'.$language->abbreviation,$general->translate($language->abbreviation)->description)}}
                                                        </textarea>

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="des{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" id="description{{$language->abbreviation}}" placeholder="" name="description{{$language->abbreviation}}"  required="" aria-required="true" aria-invalid="true">{{old('description'.$language->abbreviation,$general->translate($language->abbreviation)->description)}}
                                                        </textarea>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">คีย์เวิร์ด (meta keyword) *</label>
                                <div class="col-md-9">
                                    <div class="card card-transparent">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-linetriangle hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <li class="nav-item">
                                                        <a href="#" class="active" data-toggle="tab" data-target="#key{{$language->abbreviation}}" aria-expanded="true"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a href="#" data-toggle="tab" data-target="#key{{$language->abbreviation}}" class="" aria-expanded="false"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <div class="tab-pane fade active show" id="key{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" id="keyword{{$language->abbreviation}}" placeholder="" name="keyword{{$language->abbreviation}}"   required="" aria-required="true" aria-invalid="true">{{old('keyword'.$language->abbreviation,$general->translate($language->abbreviation)->keyword)}}
                                                        </textarea>

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="key{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" id="keyword{{$language->abbreviation}}" placeholder="" name="keyword{{$language->abbreviation}}"  required="" aria-required="true" aria-invalid="true">{{old('keyword'.$language->abbreviation,$general->translate($language->abbreviation)->keyword)}}
                                                        </textarea>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>








                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
@endsection





