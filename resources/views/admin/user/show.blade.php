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
                            <li class="breadcrumb-item "><a href="{{ route('user.all') }}">Users</a></li>
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
                                    @if(!isset($user->image))
                                        <img class="profile-user-img img-fluid img-circle" src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="{{ $user->name . ' ' . $user->last_name }}">
                                    @else 
                                        <img class="profile-user-img img-fluid img-circle" src="{{asset($user->image)}}" alt="{{ $user->name . ' ' . $user->last_name }}">
                                    @endif
                                </div>
                                <h3 class="profile-username text-center">{{ $user->name . ' ' . $user->last_name }}</h3><ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="float-right">{{ ucfirst($user->gender) ?? 'N/A' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $user->email ?? 'N/A' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Birthday</b> <a class="float-right">{{ isset($user->birth_date) ? gameHubDateFormat($user->birth_date, 'Y-m-d') : 'N/A' }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone No.</b> <a class="float-right">{{ $user->phone_number ?? 'N/A' }}</a>
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
                                @if ($user->address != null)
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Address:</td>
                                            <td>{{ $user->address->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td>{{ $user->address->city ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Post code:</td>
                                            <td>{{ $user->address->post_code ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>National ID:</td>
                                            <td>
                                                {{ $user->identification_number ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Identification Image:</td>
                                            <td>
                                                @if($user->identification_image)
                                                    <a href="{{asset($user->identification_image)}}" target="_blank">
                                                        <img height="100" src="{{asset($user->identification_image)}}" alt="Identification image">
                                                    </a>

                                                @else 
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                    <h4 class="text-center">No data available</h4>
                                @endif
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
