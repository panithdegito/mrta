@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="active">
                        <a href="javascript:;">ความคืบหน้าโครงการ</a>
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
                <li class="breadcrumb-item active">ความคืบหน้าโครงการ</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>ความคืบหน้าโครงการ

                    <a href="{{route('construct.create')}}" class="btn btn-hotel btn-primary-hotel btn-top-page pull-right" ><i class="icon-plus"></i> เพิ่มความคืบหน้า</a>
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
                    @if($errors->has('percent'))
                        <div class="alert alert-danger" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            {{$errors->first('percent')}}
                        </div>

                    @endif
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

                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <form action="{{route('construct_destroymany')}}" method="post">
                            {{csrf_field()}}
                            <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th style="width: 1%" class="sorting_desc" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="No.: activate to sort column ascending" aria-sort="descending">ลำดับ</th>
                                    <th style="width: 63%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">ชื่อ</th>
                                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Title: activate to sort column ascending">สร้างเมื่อ</th>
                                    <th style="width: 15%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1">จัดการ</th>
                                    <th style="width:1%" class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                        <button class="btn btn-link"><i class="icon-trash"></i>
                                        </button>
                                    </th>
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
                                                {{ $construct }}

                                            </td>
                                            <td class="v-align-middle">
                                                <a href="{{ route('construct.edit',$construct->id) }}" class="btn btn-hotel btn-edit pull-left" style="margin-right: 3px;"><i class="icon-pencil"></i></a>
                                                <button type="button" class="btn btn-hotel btn-delete pull-left" style="margin-right: 3px;" data-target="#deleteModal{{$construct->id}}" data-toggle="modal"><i class="icon-trash"></i></button>

                                            </td>
                                            <td class="v-align-middle">
                                                <div class="checkbox text-center">
                                                    <input type="checkbox" value="{{$construct->id}}" id="checkbox{{$construct->id}}" name="multi_id[]">
                                                    <label for="checkbox{{$construct->id}}" class="no-padding no-margin"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td></td><td>ไม่พบความคืบหน้าโครงการในตอนนี้.</td><td></td><td></td><td></td></tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr><td></td><td></td><td></td><td style="text-align: right">เลือก:</td><td><button type="button" class="btn btn-xs btn-hotel btn-delete" data-target="#deleteMany" data-toggle="modal"><i class="icon-trash"></i> ลบ</button></td>
                                    <div class="modal fade fill-in disable-scroll" id="deleteMany" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header clearfix text-left">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center m-t-20">
                                                    <h5>คุณต้องการลบความคืบหน้าโครงการนี้ที่เลือกใช่หรือไม่ ?</h5>
                                                    <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
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
                {{$constructs->links()}}
            </div>
        </div>
        <!-- END card -->

        <!-- DELETE MODAL-->
        @if(sizeof($constructs) != 0)
            @foreach ($constructs as $construct)

                <div class="modal fade fill-in disable-scroll" id="deleteModal{{$construct->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header clearfix text-left">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center m-t-20">
                                <form action="{{ route('construct.destroy', $construct->id) }}" method="post">
                                    <input type="hidden" name="_method" value="delete" />
                                    {!! csrf_field() !!}

                                    <h5>คุณต้องการลบความคืบหน้าโครงการ {{$construct}} ใช่หรือไม่ ?</h5>
                                    <button type="button" class="btn btn-hotel btn-primary-hotel" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>&nbsp;
                                    <button class="btn btn-hotel btn-delete" type="submit">ลบ</button>
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
        $('#percent').keypress(function(event) {
            if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
                    $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        }).on('paste', function(event) {
            event.preventDefault();
        });
    </script>
    @endsection

