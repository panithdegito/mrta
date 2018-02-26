@extends('layouts.admin')

@section('mini-menu')

@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('pictures.index')}}">คลังภาพโครงการ</a></li>
                <li class="breadcrumb-item active">คลังภาพความคืบหน้าสถานี {{$folder->station->translateDefault()->name}}</li>
                <li class="breadcrumb-item active">โฟลเดอร์ {{$folder->name}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>โฟลเดอร์ {{$folder->name}}
                    <button  id="uploadButton" type="button" class="btn btn-hotel btn-primary-hotel btn-top-page pull-right"  onclick="openDropzone()"><i class="icon-plus"></i> อัพโหลดรูปภาพ</button>
                    <button class="btn btn-hotel btn-edit btn-top-page pull-right"  data-target="#editFolderModal" data-toggle="modal"><i class="icon-pencil"></i></button>
                    <button class="btn btn-hotel btn-delete btn-top-page pull-right"  data-target="#deleteFolder" data-toggle="modal"><i class="icon-trash"></i></button>



                </h1>

            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class=" container    container-fixed-lg">
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <!-- START card -->
        <div class="card card-transparent">
            <div class="card-block">
                @if(Session::has('flash_message'))
                    <div class="alert alert-success" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {!! Session('flash_message') !!}
                    </div>

                @endif
                @if(Session::has('warning'))
                    <div class="alert alert-warning" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {!! Session('warning') !!}
                    </div>

                @endif
                @if(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {!! Session('danger') !!}
                    </div>

                @endif


            </div>

            <div class="row">
                <div class="col-sm-2" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px">
                    <a class="btn btn-sm btn-block btn-primary-hotel" href="{{route('stations.show', $folder->station->id)}}">
                        <i class="fa fa-folder-o"></i> กลับไปไฟลเดอร์หลัก
                    </a>
                </div>
            </div>
            <div id="dropzone" style="margin-top: 10px; margin-bottom: 15px; display: none">
                <h4>สามารถอัพโหลดซิปไฟล์ หรือไฟล์รูปภาพได้ที่นี่</h4>
                {{ Form::open(array('url' => route('uploads_progress', $folder->id), 'method' => 'PUT', 'name'=>'media_images', 'id'=>'myImageDropzone', 'class'=>'dropzone', 'files' => true)) }}

                {{ Form::close() }}
            </div>
            <div class="row">
                @if(sizeof($pictures) > 0)
                    @foreach($pictures as $picture)
                        <div class="col-sm-2 img-thumbnail" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px">
                            <a style="width: 100%" data-toggle="modal" data-target="#info{{$picture->id}}">
                                <div class= style="padding:5px">
                                    <div style="width: 100%;height: 150px;overflow: hidden;">
                                        <img src="{{config('app.url') }}/progress/{{$folder->name.'/'.$picture->name}}" style="width: auto;height: 100%" />
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-sm-12 text-center">
                        ไม่พบรูปภาพในโฟล์เดอร์นี้
                    </div>
                @endif


            </div>
        </div>
        @if(sizeof($pictures) > 0)
            @foreach($pictures as $picture)
                <div class="modal fade slide-up disable-scroll show" id="info{{$picture->id}}" tabindex="-1" role="dialog" style="display: none;height: 90%;
    top: auto;" aria-hidden="true">
                    <div class="modal-dialog modal-lg" style="width: 900px;">
                        <div class="modal-content">
                            <div class="modal-header clearfix text-left">
                                ข้อมูลไฟล์
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center m-t-20">
                                <div class="row">
                                    <div class="col-sm-7 text-center no-padding">
                                        <img src="{{config('app.url') }}/progress/{{$folder->station()->translateDefault()->code.'/'.$folder->name.'/'.$picture->name}}" style="width: 80%" />
                                    </div>
                                    <div class="col-sm-4 no-padding">
                                        <div style="text-align: left">
                                            <p><strong>ชื่อไฟล์:</strong> {{$picture->name}}</p>
                                            <p><strong>ประเภทไฟล์:</strong> {{pathinfo($picture->name, PATHINFO_EXTENSION)}}</p>
                                            <p><strong>ขนาดไฟล์:</strong> <?php
                                                list($width, $height, $type, $attr) = getimagesize(base_path('../progress/'.$folder->station()->translateDefault()->code.'/'.$folder->name.'/'.$picture->name));


                                                $filesize = filesize(base_path('../progress/'.$folder->station()->translateDefault()->code.'/'.$folder->name.'/'.$picture->name)); // bytes
                                                $filesize = round($filesize / 1024, 1); // megabytes with 1 digit
                                                echo $filesize." KB";
                                                ?>
                                            </p>
                                            <p><strong>ขนาดรูป:</strong> {{$width}} x {{$height}} พิกเซล</p>
                                            <p><strong>ลิงค์:</strong>
                                                <input type="text" class="form-control" value="{{config('app.url') }}/progress/{{$folder->station()->translateDefault()->code.'/'.$folder->name.'/'.$picture->name}}" style="width: 100%" /> </p>

                                        </div>
                                        <a href="javascript:;" class="pull-right"  data-toggle="modal" data-target="#deletePicture{{$picture->id}}"><i class="icon-trash"></i> ลบไฟล์</a>
                                    </div>

                                </div>



                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            @endforeach
        @endif

    <!-- END card -->
        <!-- EDIT FOLDER MODAL -->
        <!-- CREATE MODAL -->
        <div class="modal fade fill-in disable-scroll" id="editFolderModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        แก้ไขชื่อโฟล์เดอร์
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center m-t-20">
                        <form action="{{route('update_folder', $folder->id)}}" method="post" accept-charset="UTF-8" id="form-work" role="form" autocomplete="off" novalidate="novalidate">
                            @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('name')}}
                                </div>

                            @endif
                            <input name="_method" type="hidden" value="PUT">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="name" class=" control-label">ชื่อโฟล์เดอร์</label>
                                <input type="text" class="form-control error" id="name" placeholder="YYYY-MM-DD" name="name"  value="{{old('name',$folder->name)}}" required="" aria-required="true" aria-invalid="true">

                            </div>
                            <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                            <button class="btn btn-hotel btn-sec-hotel" type="submit">บันทึก</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /END MODAL -->
        <!-- /END EDIT FOLDER MODAL -->
        <!-- DELETE FOLDER MODAL -->

        <div class="modal fade fill-in disable-scroll" id="deleteFolder" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center m-t-20">
                        <form action="{{ route('delete_folder', $folder->id) }}" method="post">
                            <input type="hidden" name="_method" value="delete" />
                            {!! csrf_field() !!}

                            <h5>คุณต้องการลบโฟล์เดอร์ {{$folder->name}} ใช่หรือไม่ ?</h5>
                            <p>เมื่อคุณลบโฟล์เดอร์นี้รูปภาพที่อยู่ในโฟล์เดอร์นี้จะหายไป</p>
                            <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                            <button class="btn btn-hotel btn-delete" type="submit">ลบ</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- /END DELETE FOLDER MODAL -->



        <!-- DELETE MODAL-->
        @if(sizeof($pictures))
            @foreach ($pictures as $picture)

                <div class="modal fade fill-in disable-scroll" id="deletePicture{{$picture->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header clearfix text-left">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center m-t-20">
                                <form action="{{route('uploads_delete', $picture->id)}}" method="post">
                                    <input type="hidden" name="_method" value="delete" />
                                    {!! csrf_field() !!}

                                    <h5>คุณต้องการลบไฟล์ {{$picture->name}} ใช่หรือไม่ ?</h5>
                                    <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                                    <button class="btn btn-hotel btn-delete" type="submit">ลบไฟล์</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

        @endforeach
    @endif


    <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->

@endsection
@section('bottom-scripts')
    <script>
        $(document).ready(function () {
            Dropzone.options.myImageDropzone = {
                init: function () {
                    this.on("queuecomplete", function (file) {
                        location.reload();
                    });
                }
            };
        });


    </script>
    <script>
        function openDropzone() {
            document.getElementById( 'dropzone' ).style.display = 'block';
            document.getElementById( 'uploadButton' ).onclick = function(){ closeDropzone(); };
            document.getElementById( 'uploadButton' ).innerHTML = '<i class="pg-close_line fs-20"></i> ปิดดรอปโซน';

        }
        function closeDropzone() {
            document.getElementById( 'dropzone' ).style.display = 'none';
            document.getElementById( 'uploadButton' ).onclick = function(){ openDropzone(); };
            document.getElementById( 'uploadButton' ).innerHTML = '<i class="icon-plus"></i> อัพโหลดรูปภาพ';

        }
    </script>
    @if($errors->has('name'))
        <script>
            $('#editFolderModal').modal('show');
        </script>

    @endif

@endsection

