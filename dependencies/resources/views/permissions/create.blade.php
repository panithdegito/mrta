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
                <a href="#" class="search-link d-flex justify-content-between align-items-center hidden-lg-up" data-toggle="search">Tap here to search <i class="pg-search float-right"></i></a>
            </div>
        </div>
    </div>
@endsection
@section('container')
    <div class="bg-orange">
        <div class="container">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">System</a></li>
                <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">Permissions</a></li>
                <li class="breadcrumb-item active">Add Permission</li>
            </ol>
        </div>
    </div>
    <!-- START JUMBOTRON -->
    <div class="jumbotron">
        <div class=" container p-l-0 p-r-0   container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner heading-padding">
                <!-- START BREADCRUMB -->
                <h1>ADD PERMISSION

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
                        <form id="form-work" class="form-horizontal" role="form" autocomplete="off" action="{{route('permissions.store')}}" method="post" novalidate="novalidate">
                            {{csrf_field()}}
                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Name *</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control error" id="name" placeholder="Booking" name="name"  value="{{old('name')}}" required="" aria-required="true" aria-invalid="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                @if(!$roles->isEmpty())

                                <label class="col-md-3 control-label">Assign Permission to Roles</label>
                                <div class="col-md-9">
                                    @foreach ($roles as $role)
                                        {{ Form::checkbox('roles[]',  $role->id ) }}
                                        {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                    @endforeach
                                </div>
                                    @endif
                            </div>

                            <div class="row" style="padding-top: 10px">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-9">
                                    <a href="{{route('permissions.index')}}" class="btn btn-hotel btn-primary-hotel">Back</a>
                                    <button class="btn btn-hotel btn-sec-hotel" type="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- END PLACE PAGE CONTENT HERE -->
    </div>
    <!-- END CONTAINER FLUID -->
@endsection





