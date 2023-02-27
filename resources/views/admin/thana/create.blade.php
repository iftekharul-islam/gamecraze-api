@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thana</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('thana.all') }}">All Thana</a></li>
                            <li class="breadcrumb-item active">Thana</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Thana</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('thana.store') }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Platform Name" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('bn_name') ? ' has-error' : '' }}">
                                <label for="name">Bangla Name</label>
                                <input type="text" class="form-control" name="bn_name" placeholder="Enter Bangla Thana Name" required>
                                @if ($errors->has('bn_name'))
                                    <span class="text-danger"><strong>{{ $errors->first('bn_name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                                <label for="district_id">District</label>
                                @if (count($districts) > 0)
                                    <select name="district_id" id="district_id" class="form-control selectpicker" data-live-search="true" required>
                                        <option>Select a district</option>
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger" value="Please fill the district table first !!!" disabled>
                                @endif
                                @if ($errors->has('district_id'))
                                    <span class="text-danger"><strong>{{ $errors->first('district_id') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

