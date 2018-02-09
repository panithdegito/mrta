@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="active">
                        <a href="{{route('construct.index')}}">ความคืบหน้าโครงการ</a>
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
                <li class="breadcrumb-item"><a href="{{route('construct.index')}}">ความคืบหน้าโครงการ</a></li>
                <li class="breadcrumb-item active">เพิ่มความคืบหน้า</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>เพิ่มความคืบหน้า

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
                               @endforeach



                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        <form method="POST" action="{{route('construct.create')}}" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                            <div class="form-group row{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ชื่อเรื่อง*</label>
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
                                                        <input type="text" class="form-control error" id="title{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                        <input type="text" class="form-control error" id="title{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">เนื้อหา *</label>
                                <div class="col-md-9">
                                    <div class="card card-transparent">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-linetriangle hidden-sm-down" data-init-reponsive-tabs="dropdownfx">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <li class="nav-item">
                                                        <a href="#" class="active" data-toggle="tab" data-target="#content{{$language->abbreviation}}" aria-expanded="true"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a href="#" data-toggle="tab" data-target="#content{{$language->abbreviation}}" class="" aria-expanded="false"><span>{{$language->name}}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            @foreach($languages as $language)
                                                @if($language->default == 1)
                                                    <div class="tab-pane fade active show" id="content{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" placeholder="" name="content{{$language->abbreviation}}"   required="" aria-required="true" aria-invalid="true">{{old('content'.$language->abbreviation)}}
                                                        </textarea>

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="content{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" placeholder="" name="content{{$language->abbreviation}}"  required="" aria-required="true" aria-invalid="true">{{old('content'.$language->abbreviation)}}
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





