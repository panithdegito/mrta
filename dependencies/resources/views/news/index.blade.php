@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li class="active">
                        <a href="javascript:;"><span class="title">ข่าวทั้งหมด</span></a>
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
                <li class="breadcrumb-item"><a href="javascript:;">ข่าวสาร</a></li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <div class="row">
                    <div class="col-sm-6">
                        <h1>ข่าวสารทั้งหมด
                        </h1>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <form class="form-inline pull-right" action="{{route('news_typeset')}}" method="get">
                            <select class="form-control btn-top-page"  name="facility_type" onchange="this.form.submit()">
                                <option value="" selected>ดูตามประเภทข่าวสาร
                                </option>
                                @if(sizeof($news_categories) != 0)
                                    @foreach($news_categories as $news_category)
                                        @if(isset($type) and !empty($type))
                                            @if($news_category->id == $type)

                                                <option value="{{ $news_category->id }}" selected>{{ $news_category->translateDefault()->name  }}</option>
                                            @else

                                                <option value="{{ $news_category>id }}">{{ $news_category->translateDefault()->name  }}</option>
                                            @endif

                                        @else

                                            <option value="{{ $news_category->id  }}">{{ $news_category->translateDefault()->name   }}</option>
                                        @endif
                                    @endforeach

                                @else

                                @endif
                            </select>
                        </form>
                    </div>
                    <div class="col-sm-2">
                        <a href="{{route('news.create')}}" class="btn btn-hotel btn-primary-hotel btn-top-page pull-right"><i class="icon-plus"></i> เพิ่มข่าว</a>

                    </div>
                </div>

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
                        <form action="{{route('news_destroymany')}}" method="post">
                            {{csrf_field()}}
                            <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th style="width: 1%" class="sorting_desc" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="No.: activate to sort column ascending" aria-sort="descending">ลำดับ</th>
                                    <th style="width: 43%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">ชื่อ</th>
                                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Facility Type: activate to sort column ascending">ประเภทข่าว</th>
                                    <th style="width: 20%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">สถานะ</th>
                                    <th style="width: 15%" class="sorting" tabindex="0" aria-controls="basicTable" rowspan="1" colspan="1">จัดการ</th>
                                    <th style="width:1%" class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="">
                                        <button class="btn btn-link"><i class="icon-trash"></i>
                                        </button>
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                                @if(sizeof($news) != 0)
                                    @foreach ($news as $news)
                                        <tr role="row" class="odd">
                                            <td class="v-align-middle sorting_1">
                                                {{ $news->id }}
                                            </td>
                                            <td class="v-align-middle">
                                                {{ $news->translateDefault()->title }}
                                            </td>
                                            <td class="v-align-middle">
                                                {{ $news->facilityType->name }}
                                            </td>
                                            <td class="v-align-middle">
                                                {{ $news->status->name }}
                                            </td>
                                            <td class="v-align-middle">
                                                <a href="{{ route('news.edit',$news->id) }}" class="btn btn-hotel btn-edit pull-left" style="margin-right: 3px;"><i class="icon-pencil"></i></a>
                                                <button type="button" class="btn btn-hotel btn-delete pull-left" style="margin-right: 3px;" data-target="#deleteModal{{$news->id}}" data-toggle="modal"><i class="icon-trash"></i></button>
                                            </td>
                                            <td class="v-align-middle">
                                                <div class="checkbox text-center">
                                                    <input type="checkbox" value="{{$news->id}}" id="checkbox{{$news->id}}" name="multi_id[]">
                                                    <label for="checkbox{{$news->id}}" class="no-padding no-margin"></label>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr><td></td><td>ไม่พบข่าวสารในตอนนี้</td><td></td><td></td><td></td><td></td></tr>

                                @endif




                                </tbody>
                                <tfoot>
                                <tr><td></td><td></td><td></td><td></td><td style="text-align: right">เลือก:</td><td><button type="button" class="btn btn-xs btn-hotel btn-delete" data-target="#deleteMany" data-toggle="modal"><i class="icon-trash"></i> ลบ</button></td>
                                    <div class="modal fade fill-in disable-scroll" id="deleteMany" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header clearfix text-left">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center m-t-20">
                                                    <h5>คุณต้องการลบข้อมูลข่าวที่เลือกใช่หรือไม่ ?</h5>
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
                {{$news->links()}}
            </div>
        </div>

        <!-- DELETE MODAL -->
        @if(sizeof($news) != 0)
            @foreach ($news as $news)
                <div class="modal fade fill-in disable-scroll" id="deleteModal{{$news->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header clearfix text-left">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center m-t-20">
                                <form action="{{ route('news.destroy', $news->id) }}" method="post">
                                    <input type="hidden" name="_method" value="delete" />
                                    {!! csrf_field() !!}
                                    <h5>คุณต้องการลบข่าวนี้ใช่หรือไม่ ?</h5>
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
    <!-- END card -->


        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->

@endsection

