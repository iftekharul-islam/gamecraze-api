@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>District</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('district.all') }}">All district</a></li>
                            <li class="breadcrumb-item active">District</li>
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
                        <h3 class="card-title">Add District</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('district.store') }}" class="w-75 mx-auto">
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
                                <input type="text" class="form-control" name="bn_name" placeholder="Enter Bangla District Name" required>
                                @if ($errors->has('bn_name'))
                                    <span class="text-danger"><strong>{{ $errors->first('bn_name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('division_id') ? ' has-error' : '' }}">
                                <label for="division_id">District</label>
                                @if (count($divisions) > 0)
                                    <select name="division_id" id="division_id" class="form-control selectpicker" data-live-search="true" required>
                                        <option>Select a division</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger" value="Please fill the District table first !!!" disabled>
                                @endif
                                @if ($errors->has('division_id'))
                                    <span class="text-danger"><strong>{{ $errors->first('division_id') }}</strong></span>
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

