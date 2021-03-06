@extends('layouts.admin')

@section('mini-menu')

@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{route('stations.index')}}">ความคืบหน้าโครงการ</a></li>
                <li class="breadcrumb-item active">คลังภาพความคืบหน้าสถานี {{$station->translateDefault()->name}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>คลังภาพความคืบหน้า<br>สถานี{{$station->translateDefault()->name}}
                    <button class="btn btn-hotel btn-primary-hotel pull-right"  data-target="#createModal" data-toggle="modal"><i class="fa fa-folder-o"></i> เพิ่มโฟลเดอร์</button>
                    <a href="{{route('stations.index')}}" class="btn btn-hotel btn-sec-hotel pull-right">กลับ</a>

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
            <div>

            </div>
            <div class="row">
                @if(sizeof($folders) > 0)
                    @foreach($folders as $folder)
                        <div class="col-sm-2" style="padding-left: 5px; padding-right: 5px; padding-bottom: 5px">
                            <a href="{{route('show_folder', $folder->id)}}" class="btn btn-block btn-default" >
                                <i class="fa fa-folder-o fa-2x"></i><Br>
                                {{$folder->name}}
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-sm-12 text-center">
                        ไม่พบโฟล์เดอร์ในตอนนี้
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center">
            {{$folders->links()}}
        </div>
        <!-- END card -->
        <!-- CREATE MODAL -->
        <div class="modal fade fill-in disable-scroll" id="createModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        ตั้งชื่อโฟล์เดอร์
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                    </div>
                    <div class="modal-body text-center m-t-20">
                        <form action="{{ route('add_folder', $station->id) }}" method="post" novalidate>
                            {!! csrf_field() !!}
                            <div class="form-group row">
                                <label for="name" class=" control-label">ชื่อโฟล์เดอร์</label>
                                <input type="text" class="form-control error" id="name" placeholder="YYYY-MM-DD" name="name"  value="{{old('name')}}" required="" aria-required="true" aria-invalid="true">

                            </div>
                            <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                            <button class="btn btn-hotel btn-sec-hotel" type="submit">สร้าง</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /END MODAL -->



    <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->

@endsection

@section('bottom-scripts')

@endsection

