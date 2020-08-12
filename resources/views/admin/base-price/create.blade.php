@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Base Price</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Base Price</li>
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
                        <h3 class="card-title">Add Base Price</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('basePrice.store') }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                                <label for="start">Start Price</label>
                                <input type="number" class="form-control" id="start" name="start" placeholder="Enter start price">
                                @if ($errors->has('start'))
                                    <span class="text-danger"><strong>{{ $errors->first('start') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                <label for="end">End Price</label>
                                <input type="number" class="form-control" id="end" name="end" placeholder="Enter end price">
                                @if ($errors->has('end'))
                                    <span class="text-danger"><strong>{{ $errors->first('end') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('base') ? ' has-error' : '' }}">
                                <label for="base">Base Price</label>
                                <input type="number" class="form-control" id="base" name="base" placeholder="Enter Base price">
                                @if ($errors->has('base'))
                                    <span class="text-danger"><strong>{{ $errors->first('base') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
@endsection
