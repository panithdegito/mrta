@extends('layouts.admin')
@section('top-scripts')
    <link href="{{asset('/admin-assets/assets/plugins/css/datepicker.css')}}" rel="stylesheet">
@endsection
@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="active">
                        <a href="{{route('stations.index')}}">ความคืบหน้าโครงการ</a>
                    </li>

                    <li>
                        <a href="{{route('pictures.index')}}"><span class="title">คลังภาพโครงการ</span></a>
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
                <li class="breadcrumb-item"><a href="{{route('stations.index')}}">ความคืบหน้าโครงการ</a></li>
                <li class="breadcrumb-item active">เพิ่มสถานี</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>เพิ่มสถานี
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
                                    @if($errors->has('name'.$language->abbreviation)) {{$errors->first('name'.$language->abbreviation)}}<br> @endif
                                @endforeach

                                @if($errors->has('code')) {{$errors->first('code')}} <br> @endif
                                @if($errors->has('kilometer_marker')) {{$errors->first('kilometer_marker')}} <br> @endif
                                @if($errors->has('status')) {{$errors->first('status')}} @endif



                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        <form method="POST" action="{{route('stations.store')}}" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group row{{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">รหัสสถานี *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="code" placeholder="OR01" name="code"  value="{{old('code')}}" required="" aria-required="true" aria-invalid="true" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อสถานี*</label>
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
                                                        <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                        <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('progress') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-3 control-label">ความคืบหน้า (%) *</label>
                                <div class="col-md-9">
                                    <div class="input-group date col-md-12 p-l-0">
                                        <input type="text" class="form-control allownumericwithdecimal" name="progress" placeholder="00.00"><span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('kilometer') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">กม. ที่ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error allownumericwithdecimal" id="kilometer" placeholder="00.00" name="kilometer"  value="{{old('kilometer')}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-3 control-label">สถานะ *</label>
                                <div class="col-md-9">
                                    @foreach($status as $status)
                                        @if(old('status') == $status->id)
                                            {{ Form::radio('status',  $status->id, true) }}
                                            {{ Form::label($status->name, ucfirst($status->name)) }}<br>
                                        @else
                                            {{ Form::radio('status',  $status->id ) }}
                                            {{ Form::label($status->name, ucfirst($status->name)) }}<br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                @if(!$roles->isEmpty())

                                    <label class="col-md-3 control-label">ผู้มีสิทธิ์เข้าถึง</label>
                                    <div class="col-md-9">
                                        @foreach ($roles as $role)
                                            {{ Form::checkbox('roles[]',  $role->id ) }}
                                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                        @endforeach
                                    </div>
                                @endif
                            </div>










                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">

                                    <a href="{{route('stations.index')}}" class="btn btn-hotel btn-primary-hotel">กลับ</a>
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">เพิ่ม</button>
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

@section('bottom-scripts')
    <script>
        $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    </script>


@endsection





