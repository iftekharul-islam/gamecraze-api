@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Discount</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Discount</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content col-8">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Discount</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('discount.store') }}" class="w-75 mx-auto">
                            @csrf
                            <div class="card-body">
                                <div class="false-padding-bottom-form form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="amount">Type</label>
                                    <input type="text" class="form-control" name="type" placeholder="Enter type" required>
                                    @if ($errors->has('type'))
                                        <span class="text-danger"><strong>{{ $errors->first('type') }}</strong></span>
                                    @endif
                                </div>
                                <div class="false-padding-bottom-form form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="amount">Code</label>
                                    <input type="text" class="form-control" name="code" placeholder="Enter type">
                                    @if ($errors->has('code'))
                                        <span class="text-danger"><strong>{{ $errors->first('code') }}</strong></span>
                                    @endif
                                </div>
                                <div class="false-padding-bottom-form form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" required>
                                    @if ($errors->has('amount'))
                                        <span class="text-danger"><strong>{{ $errors->first('amount') }}</strong></span>
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
