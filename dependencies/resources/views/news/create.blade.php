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
                        <a href="{{route('news.index')}}"><span class="title">ข่าวทั้งหมด</span></a>
                    </li>
                    <li>
                        <a href="{{route('news-categories.index')}}">ประเภทข่าวสาร</a>
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
                <li class="breadcrumb-item"><a href="{{route('news.index')}}">ข่าวสาร</a></li>
                <li class="breadcrumb-item active">เพิ่มข่าวสาร</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>เพิ่มข่าวสาร

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
                                    @if($errors->has('title'.$language->abbreviation)) {{$errors->first('title'.$language->abbreviation)}}<br> @endif
                                    @if($errors->has('content'.$language->abbreviation)) {{$errors->first('content'.$language->abbreviation)}}<br> @endif
                                @endforeach

                                @if($errors->has('status')) {{$errors->first('status')}} @endif
                                @if($errors->has('date')) {{$errors->first('date')}} @endif
                                @if($errors->has('photo')) {{$errors->first('photo')}} @endif



                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        <form method="POST" action="{{route('news.store')}}" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
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
                                                        <input type="text" class="form-control error" id="title{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

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

                            <div class="form-group row{{ $errors->has('photo') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">ภาพหัวข่าว *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="photo" placeholder="" name="photo"  value="{{old('photo')}}" required="" aria-required="true" aria-invalid="true" style="width: 80%;display: inline-block" readonly>
                                    <button class="btn btn-hotel btn-primary-hotel" data-toggle="modal" data-target="#selectPhoto" type="button">เลือกรูปภาพ</button>

                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">วันที่เผยแพร่ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="date" placeholder="" name="date"  value="{{old('date')}}" required="" aria-required="true" aria-invalid="true">


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










                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">

                                    <a href="{{route('news.index')}}" class="btn btn-hotel btn-primary-hotel">กลับ</a>
                                    <button class="btn btn-hotel btn-primary-hotel" type="button">พรีวิว</button>
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">เพิ่ม</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if(sizeof($pictures) > 0)

            <div class="modal fade slide-up disable-scroll show" id="selectPhoto" tabindex="-1" role="dialog" style="display: none;height: 90%;
    top: auto;" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width: 900px;">
                    <div class="modal-content">
                        <div class="modal-header clearfix text-left">
                            เลือกโฟลเดอร์
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                            </button>
                        </div>
                        <div class="modal-body text-center m-t-20">
                            <div class="row">
                                @foreach($pictures as $picture)
                                    <div class="col-sm-3 img-thumbnail" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px">
                                        <a href="javascript:inputFile('{{$picture->name}}');"  style="width: 100%">
                                            <div class= style="padding:5px">
                                                <div style="width: 100%;height: 150px;overflow: hidden;">
                                                    <img src="{{config('app.url') }}/media/{{'/'.$picture->name}}" style="width: auto;height: 100%" />
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                @endforeach
                            </div>



                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>

    @endif



    <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
@endsection

@section('bottom-scripts')
    <script src="{{asset('/admin-assets/assets/js/bootstrap-datepicker-custom.js')}}"></script>
    <script src="{{asset('/admin-assets/assets/js/bootstrap-datepicker.th.min.js')}}"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=cnerpktnjfyyrxrfhnm6tb2a8ogjm4dcy5s4i7sk7g42wwl5"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            branding: false,
            menubar: false,
            height: 480,
            toolbar: "undo, redo, cut, copy, paste,styleselect, bold, italic, underline, removeformat, formats, forecolor backcolor,link, table, image,  code, ",
            plugins: "image imagetools code textcolor colorpicker table codesample link textpattern",
            block_formats: 'Paragraph=p;Header 1=h1;Header 2=h2;Header 3=h3'
        });
    </script>
    <script>
        function inputFile(files) {
            var file = files;
            //alert(file);
            $("#photo").val(file);
            $("#selectPhoto").modal('hide');

        }
    </script>
    <script>
        $(document).ready(function () {
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>
@endsection





