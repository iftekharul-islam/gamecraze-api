@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Coupon</li>
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
                            <h3 class="card-title">Add Coupon</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('coupon.store') }}" class="w-75 mx-auto">
                            @csrf
                            <div class="card-body">
                                <div class="false-padding-bottom-form form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="amount">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                    @endif
                                </div>
                                <div class="false-padding-bottom-form form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                                    <label for="amount">Code</label>
                                    <input type="text" class="form-control" name="code" placeholder="Enter code">
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
                                    <label for="amount_type">Amount Type</label>
                                    <select name="amount_type" class="form-control">
                                        <option value="">Select user type</option>
                                        <option value="1">Flat</option>
                                        <option value="2">Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" class="form-control">
                                        <option value="">All User</option>
                                        <option value="1">Rookie</option>
                                        <option value="2">Elite</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="status">For specific User</label>
                                    <select name="set_user_id" class="form-control user-select">
                                        <option value="" selected>Select a user</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="false-padding-bottom-form form-group {{ $errors->has('limit') ? ' has-error' : '' }}">
                                    <label for="limit">Limit</label>
                                    <input type="number" class="form-control" id="limit" min="1" max="10" name="limit" placeholder="Enter limit">
                                    @if ($errors->has('limit'))
                                        <span class="text-danger"><strong>{{ $errors->first('limit') }}</strong></span>
                                    @endif
                                </div>

                                <div class="false-padding-bottom-form form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label for="limit">Start date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    @if ($errors->has('start_date'))
                                        <span class="text-danger"><strong>{{ $errors->first('start_date') }}</strong></span>
                                    @endif
                                </div>

                                <div class="false-padding-bottom-form form-group {{ $errors->has('end_date') ? ' has-error' : '' }}">
                                    <label for="limit">End date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    @if ($errors->has('end_date'))
                                        <span class="text-danger"><strong>{{ $errors->first('end_date') }}</strong></span>
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
    <script>
        $(document).ready(function() {
            $('.user-select').select2();
        });
    </script>
@endsection
