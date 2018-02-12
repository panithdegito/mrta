@extends('layouts.admin')
@section('top-scripts')
    <link href="{{asset('admin-assets/assets/plugins/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">
    @endsection
@section('mini-menu')

@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">เมนู</a></li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>เมนู
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
                <div class="col-sm-6">
                    <div class="card card-transparent">

                        <div class="card-block">
                            <p>สามารถลากเพื่อจัดลำดับ</p>

                        </div>
                    </div>
                    @if(sizeof($menus) > 0)
                        @foreach($menus as $menu)
                            @if($menu->childof == '0' )
                                <li class="dd-item dd3-item" data-id="{{ $menu->id }}">
                                    <div class="dd-handle dd3-handle">Drag</div>
                                    <div class="dd3-content">
                                        {{ $menu->translateDefault()->name  }}

                                        <button class="btn btn-xs btn-hotel btn-delete"  style="float: right; margin-left: 2px;" data-target="#deleteModal{{$menu->id}}" data-toggle="modal"><i class="icon-trash"></i></button>
                                        <a href="{{route('menus.edit',$menu->id)}}" class="btn btn-xs btn-hotel btn-edit" style="float: right;"><i class="icon-pencil"></i> </a>
                                    </div>
                                    <?php
                                    $menu_child = \App\Menu::where('childof',$menu->id)->orderBy('subordering')->get();
                                    ?>
                                    @if(!empty($menu_child))
                                        @foreach($menu_child as $child)
                                            <?php
                                            ?>
                                            <ol class="dd-list">
                                                <li class="dd-item dd3-item" data-id="{{ $child->id }}">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">{{ $child->translateDefault()->name }}
                                                        <button class="btn btn-xs btn-hotel btn-delete"  style="float: right; margin-left: 2px;" data-target="#deleteModal{{$child->id}}" data-toggle="modal"><i class="icon-trash"></i></button>
                                                        <a href="{{route('menus.edit',$child->id)}}" class="btn btn-xs btn-hotel btn-edit" style="float: right;"><i class="icon-pencil"></i></a>
                                                    </div>
                                                </li>
                                            </ol>

                                        @endforeach
                                    @endif

                                </li>
                            @endif
                        @endforeach
                    @else
                    <div class="text-center">
                        ยังไม่มีเมนูไอเท็มในตอนนี้
                    </div>
                        @endif
                </div>
                <div class="col-sm-6">

                    @if (sizeof($errors) != 0)
                        <div class="alert alert-danger" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            @foreach($languages as $language)
                                @if($errors->has('name'.$language->abbreviation)) {{$errors->first('name'.$language->abbreviation)}}<br> @endif
                           @endforeach

                            @if($errors->has('path')) {{$errors->first('path')}} @endif



                        </div>


                    @endif
                    <div class="card card-default">
                        <div class="card-header">
                            เพิ่มเมนูไอเท็ม
                        </div>

                        <div class="card-block">
                            <form action="{{route('menus.store')}}" method="post" accept-charset="UTF-8" id="form-work" class="form-horizontal" role="form" autocomplete="off" novalidate="novalidate">

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
                                                            <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

                                                        </div>
                                                    @else
                                                        <div class="tab-pane" id="{{$language->abbreviation}}" aria-expanded="true">
                                                            <input type="text" class="form-control error" id="name{{$language->abbreviation}}" placeholder="" name="name{{$language->abbreviation}}"  value="{{old('name'.$language->abbreviation)}}" required="" aria-required="true" aria-invalid="true">

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
                                            <input type="text" style="width: 100%" name="path" id="path" class="form-control" value="{{old('path')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 10px">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">

                                        <button class="btn btn-hotel btn-sec-hotel" type="submit">เพิ่ม</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div style="text-align: center">

            </div>
        </div>

        <!-- DELETE MODAL -->
        @if(sizeof($menus))
            @foreach ($menus as $menu)
                <div class="modal fade fill-in disable-scroll" id="deleteModal{{$menu->id}}" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header clearfix text-left">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                                </button>
                            </div>
                            <div class="modal-body text-center m-t-20">
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                    <input type="hidden" name="_method" value="delete" />
                                    {!! csrf_field() !!}
                                    <h5>คุณต้องการลบเมนู {{$menu->translateDefault()->name}} ใช่หรือไม่ ?</h5>
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

@section('bottom-scripts')
    <script src="{{asset('/admin-assets/assets/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
    <script src="{{asset('/admin-assets/assets/js/nestable.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target), output = list.data('output');
                var requestData = JSON.stringify(list.nestable('serialize'));
                console.log(requestData);

                request = $.ajax({
                    url: "#",
                    method: "GET",
                    dataType: "json",
                    data: {_token :'{{ csrf_token() }}',data : requestData}
                    /* success: function(data) {
                         alert(data);
                     }*/

                })/*.fail(function(jqXHR, textStatus, errorThrown){
                    alert("Unable to save new list order: " + errorThrown);
                })*/;
            };

            $('#nestable').nestable({
                group: 1,
                maxDepth: 7,
            }).on('change', updateOutput);
        });
    </script>
    @endsection

