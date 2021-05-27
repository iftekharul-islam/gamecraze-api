@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Coupon</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content col-8">
            <div class="container-fluid">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('discount.update', $data->id) }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" value="{{ $data->type }}">
                                @if ($errors->has('type'))
                                    <span class="text-danger"><strong>{{ $errors->first('type') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" value="{{ $data->code }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger"><strong>{{ $errors->first('code') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="{{ $data->amount }}">
                                @if ($errors->has('amount'))
                                    <span class="text-danger"><strong>{{ $errors->first('amount') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
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

