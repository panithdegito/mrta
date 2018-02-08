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

                    <li class="active">
                        <a href="javascript:;"><span class="title">สิทธิ์การเข้าถึง</span></a>
                    </li>

                    <li>
                        <a href="{{route('generals.index')}}"><span class="title">ข้อมูลทั่วไป</span></a>
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
                <li class="breadcrumb-item"><a href="/admin/dashboard">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">ตั้งค่า</a></li>
                <li class="breadcrumb-item active">สิทธิ์การเข้าถึง</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>สิทธิ์การเข้าถึง

                    <a href="{{route('roles.create')}}" class="btn btn-hotel btn-primary-hotel btn-top-page pull-right"><i class="icon-plus"></i> เพิ่มสิทธิ์การเข้าถึง</a>
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
                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <form action="{{route('roles_destroymany')}}" method="post">
                            {{csrf_field()}}
                            <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th style="width: 1%" class="sorting_desc" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="No.: activate to sort column ascending" aria-sort="descending">ลำดับ</th>
                                    <th style="width: 83%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">ชื่อ</th>
                                    <th style="width: 15%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1">จัดการ</th>
                                    <th style="width:1%" class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                        <button class="btn btn-link"><i class="icon-trash"></i>
                                        </button>
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                                @if(sizeof($roles) != 0)
                                    @foreach ($roles as $role)
                                        <tr role="row" class="odd">
                                            <td class="v-align-middle sorting_1">
                                                {{ $role->id }}
                                            </td>
                                            <td class="v-align-middle">
                                                {{ $role->name }}
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-hotel btn-edit pull-left" style="margin-right: 3px;"><i class="icon-pencil"></i></a>
                                                <button type="button" class="btn btn-hotel btn-delete pull-left" style="margin-right: 3px;" data-target="#deleteModal{{$role->id}}" data-toggle="modal"><i class="icon-trash"></i></button>
                                                <div class="modal fade fill-in disable-scroll" id="deleteModal{{$role->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header clearfix text-left">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center m-t-20">
                                                                <h5>คุณต้องการลบสิทธิ์ {{$role->name}} ใช่หรือไม่ ?</h5>
                                                                <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                                                                <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-hotel btn-delete">ลบ</a>

                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </td>
                                            <td class="v-align-middle">
                                                <div class="checkbox text-center">
                                                    <input type="checkbox" value="{{$role->id}}" id="checkbox{{$role->id}}" name="multi_id[]">
                                                    <label for="checkbox{{$role->id}}" class="no-padding no-margin"></label>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                    @else
                                    <tr><td></td><td>ไม่พบสิทธิ์การเข้าถึงในตอนนี้.</td><td></td><td></td></tr>


                                @endif





                                </tbody>
                                <tfoot>
                                <tr><td></td><td></td><td style="text-align: right">เลือก:</td><td><button type="button" class="btn btn-xs btn-hotel btn-delete" data-target="#deleteMany" data-toggle="modal"><i class="icon-trash"></i> ลบ</button></td>
                                    <div class="modal fade fill-in disable-scroll" id="deleteMany" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header clearfix text-left">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center m-t-20">
                                                    <h5>คุณต้องการลบสิทธิ์การเข้าถึงที่เลือกใช่หรือไม่ ?</h5>
                                                    <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ลบ</button>&nbsp;
                                                    <button class="btn btn-hotel btn-delete" type="submit">ลบ</button>

                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </tr>



                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div style="text-align: center">
                {{$roles->links()}}
            </div>
        </div>
        <!-- END card -->


        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->

@endsection