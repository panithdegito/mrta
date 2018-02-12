@extends('layouts.admin')

@section('mini-menu')

    @endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="#">หน้าแรก</a></li>
                <li class="breadcrumb-item active">แดชบอร์ด</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>แดชบอร์ด</h1>
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    <!-- START CONTAINER FLUID -->
    <div class=" container    container-fixed-lg">
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <div class=" container    container-fixed-lg">
            <div class="row">
                <div class="col-lg-12">
                    <!-- START card -->
                    <h3 style="color: #333333">ยินดีต้อนรับสู่ระบบจัดการหลังบ้านของ</h3>
                    <h5 style="color: #333333">
                        <?php
                        $title = \App\General::first();
                        echo $title->translateDefault()->title;
                        ?>
                    </h5>
                    <!-- END card -->
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
                    @if($errors->has('percent'))
                        <div class="alert alert-danger" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            {{$errors->first('percent')}}
                        </div>

                    @endif
                </div>

            </div>
        </div>
        <div class=" container    container-fixed-lg">
            <div class="row">
                <div class="col-lg-12">
                    <!-- START card -->
                    <div class="card card-default">

                        <div class="card-block">
                            <form action="{{route('percent.update', 1)}}" method="post" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">
                                <input name="_method" type="hidden" value="PUT">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h3>ความคืบหน้าโครงการตอนนี้</h3>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control error" id="percent" name="percent"  value="{{old('percent',$percent->percent)}}" required="" aria-required="true" aria-invalid="true" style="margin-top: 10px; font-size: 20px; text-align: center" maxlength="6">
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <h3>เปอร์เซนต์</h3>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-block btn-hotel btn-sec-hotel" type="submit" style="margin-top: 10px;">อัพเดต</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END card -->
                </div>

            </div>

            <div class="container container-fixed-lg" style="padding: 0px">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- START card -->
                        <div class="card card-transparent">
                            <div class="card-header" style="padding: 0px">
                                <h3>ความคืบหน้าที่รอการอนุมัติ</h3>
                            </div>
                            <div class="card-block" style="padding: 0px">



                                <div class="table-responsive">
                                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                                            <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                                                <thead>
                                                <tr role="row">
                                                    <th style="width: 2%" class="sorting_desc" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="No.: activate to sort column ascending" aria-sort="descending">ลำดับ</th>
                                                    <th style="width: 43%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">ชื่อ</th>
                                                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">สถานะ</th>
                                                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">สร้างเมื่อ</th>
                                                    <th style="width: 15%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1">จัดการ</th>

                                                </tr>

                                                </thead>
                                                <tbody>
                                                @if(sizeof($constructs) != 0)
                                                    @foreach ($constructs as $construct)
                                                        <tr role="row" class="odd">
                                                            <td class="v-align-middle sorting_1">
                                                                {{ $construct->id }}
                                                            </td>
                                                            <td class="v-align-middle">
                                                                {{ $construct->translateDefault()->title }}

                                                            </td>
                                                            <td class="v-align-middle">
                                                                {{ $construct->status->name }}

                                                            </td>
                                                            <td class="v-align-middle">
                                                                {{ $construct->created_at }}

                                                            </td>
                                                            <td class="v-align-middle">
                                                                <a href="#" class="btn btn-hotel btn-edit pull-left" style="margin-right: 3px;">ดู</a>
                                                                <a href="{{route('construct_update_status',$construct->id)}}" class="btn btn-hotel btn-delete pull-left" style="margin-right: 3px;">อนุมัติ</a>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td></td><td>ไม่พบความคืบหน้าโครงการในตอนนี้.</td><td></td><td></td><td></td></tr>
                                                @endif
                                                </tbody>

                                            </table>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: center">
                            </div>
                        </div>
                        <!-- END card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PLACE PAGE CONTENT HERE -->


    </div>
    <!-- END CONTAINER FLUID -->
@endsection
