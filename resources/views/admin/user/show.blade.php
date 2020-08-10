@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif<!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile ">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}"
                                         alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $user->name }}</h3><ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="float-right">{{ $user->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Birthday</b> <a class="float-right">{{ $user->birth_date }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone No.</b> <a class="float-right">{{ $user->phone_number }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User details</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td>Location:</td>
                                        <td>{{ $user->address->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td>{{ $user->address->address_line_1 }}</td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td>Mode:</td>--}}
{{--                                        <td>{{ $rent->game->game_mode }}</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Platform:</td>--}}
{{--                                        <td>{{ $rent->platform->name ?? '' }}</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Rating:</td>--}}
{{--                                        <td>{{ $rent->game->rating }}</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Disk condition:</td>--}}
{{--                                        <td>{{ $rent->diskCondition->name ?? '' }} ({{ $rent->diskCondition->description ?? '' }})</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>Max Rent Week:</td>--}}
{{--                                        <td>{{ $rent->max_week }}</td>--}}
{{--                                    </tr>--}}
                                    </tbody>
                                </table>
                                <hr class="fancy4">
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
