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
                <li class="breadcrumb-item active">แก้ไขความคืบหน้า {{$construct->translateDefault()->title}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>แก้ไขความคืบหน้า {{$construct->translateDefault()->title}}

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

                                @if($errors->has('folder')) {{$errors->first('folder')}} @endif



                            </div>


                        @endif
                        <p class="small hint-text">* จำเป็นต้องระบุ</p>
                        <form method="POST" action="{{route('construct.update', $construct->id)}}" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                            <input name="_method" type="hidden" value="PUT">
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
                                                        <input type="text" class="form-control error" id="title{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation, $construct->translate($language->abbreviation)->title)}}" required="" aria-required="true" aria-invalid="true">

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                        <input type="text" class="form-control error" id="title{{$language->abbreviation}}" placeholder="" name="title{{$language->abbreviation}}"  value="{{old('title'.$language->abbreviation, $construct->translate($language->abbreviation)->title)}}" required="" aria-required="true" aria-invalid="true">

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
                                                        <textarea class="form-control error" placeholder="" name="content{{$language->abbreviation}}"   required="" aria-required="true" aria-invalid="true">{{old('content'.$language->abbreviation, $construct->translate($language->abbreviation)->title)}}
                                                        </textarea>

                                                    </div>
                                                @else
                                                    <div class="tab-pane" id="content{{$language->abbreviation}}" aria-expanded="true">
                                                        <textarea class="form-control error" placeholder="" name="content{{$language->abbreviation}}"  required="" aria-required="true" aria-invalid="true">{{old('content'.$language->abbreviation, $construct->translate($language->abbreviation)->title)}}
                                                        </textarea>

                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('folder') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">รหัสโฟลเดอร์ภาพ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="folder" placeholder="" name="folder"  value="{{old('folder', $construct->folder_id)}}" required="" aria-required="true" aria-invalid="true" style="width: 80%;display: inline-block" readonly>
                                    <button class="btn btn-hotel btn-primary-hotel" data-toggle="modal" data-target="#selectFolder" type="button">เลือกโฟล์เดอร์</button>

                                </div>
                            </div>
                            <div class="form-group row{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">วันที่เผยแพร่ *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="date" placeholder="" name="date"  value="{{old('date', $construct->publish_date)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>

                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">

                                    <a href="{{route('construct.index')}}" class="btn btn-hotel btn-primary-hotel">กลับ</a>
                                    <button class="btn btn-hotel btn-primary-hotel" type="button">พรีวิว</button>
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if(sizeof($folders) > 0)

                <div class="modal fade slide-up disable-scroll show" id="selectFolder" tabindex="-1" role="dialog" style="display: none;height: 90%;
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
                                    @foreach($folders as $folder)
                                        <div class="col-sm-2" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px">
                                            <a href="javascript:inputFile({{$folder->id}});" class="btn btn-block btn-default" >
                                                <i class="fa fa-folder-o fa-2x"></i><Br>
                                                {{$folder->name}}
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
            $("#folder").val(file);
            $("#selectFolder").modal('hide');

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





