@extends('layouts.admin')

@section('mini-menu')
    <div class="bg-orange">
        <div class="container">
            <div class="menu-bar header-sm-height" data-pages-init='horizontal-menu' data-hide-extra-li="4">
                <a href="#" class="btn-link toggle-sidebar hidden-lg-up pg pg-close" data-toggle="horizontal-menu">
                </a>
                <ul>
                    <li>
                        <a href="{{route('users.index')}}">Users Management</a>
                    </li>

                    <li>
                        <a href="{{route('roles.index')}}"><span class="title">Roles</span></a>
                    </li>
                    <li class="active">
                        <a href="{{route('permissions.index')}}">Permissions</a>
                    </li>
                    <li>
                        <a href="{{route('statuses.index')}}"><span class="title">Default Statuses</span></a>
                    </li>


                    <li>
                        <a href="{{route('languages.index')}}"><span class="title">Languages</span></a>
                    </li>

                </ul>
             </div>
        </div>
    </div>
@endsection
@section('container')
    <div class="bg-white">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">System</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">Edit Permission {{$permission->name}}</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>EDIT PERMISSION {{strtoupper($permission->name)}}

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
                        @if ($errors->has('name'))
                            <div class="alert alert-danger" role="alert">
                                <button class="close" data-dismiss="alert"></button>
                                {{ $errors->first('name') }}

                            </div>

                        @endif
                        <p class="small hint-text">* Indicates a required field.</p>
                            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT', 'id' => 'form-work', 'class' => 'form-horizontal', 'role'=>'form', 'autocomplete'=>'off','novalidate'=>'novalidate')) }}{{-- Form model binding to automatically populate our fields with permission data --}}
                            {{csrf_field()}}
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="name" placeholder="Booking" name="name"  value="{{old('name',$permission->name)}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>

                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">
                                    <a href="{{route('permissions.index')}}" class="btn btn-hotel btn-primary-hotel">Back</a>
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">Save Changes</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>



        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
@endsection