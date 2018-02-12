@extends('layouts.admin')

@section('mini-menu')

@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('menus.index')}}">เมนู</a></li>
                <li class="breadcrumb-item active">แก้ไข {{$menu->translateDefault()->name}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>แก้ไข {{$menu->translateDefault()->name}}

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
                                @if($errors->has('path')){{$errors->first('path')}}@endif


                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                            <form action="{{route('menus.update',$menu->id)}}" method="post" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                                <input name="_method" type="hidden" value="PUT">
                                {{csrf_field()}}
                                <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
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
                                                            <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation, $menu->translate($language->abbreviation)->name)}}" required="" aria-required="true" aria-invalid="true">

                                                        </div>
                                                    @else
                                                        <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                            <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation,  $menu->translate($language->abbreviation)->name)}}" required="" aria-required="true" aria-invalid="true">

                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('path') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-3 control-label">พาร์ท *</label>
                                    <div class="col-md-9">
                                        <div class="input-prepend input-group">
                                            <span class="add-on input-group-addon">{{config('app.url') }}/</span>
                                            <input type="text" style="width: 100%" name="path" id="path" class="form-control" value="{{old('path',$menu->link)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 10px">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">

                                        <a href="{{route('menus.index')}}" class="btn btn-hotel btn-primary-hotel">กลับ</a>
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

@section('bottom-scripts')

@endsection





