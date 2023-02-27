@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vendor User Assign</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vendor.owner') }}">Vendor Users</a></li>
                            <li class="breadcrumb-item active">Vendor user assign</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
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
                @endif
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('assign.user') }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="user">User :</label>
                                            <select name="user_id" id="user" class="form-control selectpicker"
                                                    data-live-search="true" required>
                                                <option value="" disabled selected>Select User</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="user">Vendor :</label>
                                            <select name="vendor_id" id="user" class="form-control selectpicker"
                                                    data-live-search="true" required>
                                                <option value="" disabled selected>Select Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->shop_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="role">User role:</label>
                                            <select name="role_id" id="role" class="form-control selectpicker"
                                                    required>
                                                <option value="" disabled selected>Select User Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{ ucwords(str_replace("_", " ", $role->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 form-group float-right">
                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

