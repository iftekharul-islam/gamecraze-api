@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payments</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Payments</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
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

        <!-- Main content -->
        <section class="content col-md-7">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Make payment</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('payment', request()->id) }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount ..." required>
                                @if ($errors->has('amount'))
                                    <span class="text-danger"><strong>{{ $errors->first('amount') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('transaction_id') ? ' has-error' : '' }}">
                                <label for="transaction_id">Transaction Id</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Enter transaction id ..." required>
                                @if ($errors->has('transaction_id'))
                                    <span class="text-danger"><strong>{{ $errors->first('transaction_id') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                <label for="end">Payment type</label>
                                <select name="payment_type" class="form-control selectpicker">
                                    <option value="bkash">Bkash</option>
                                    <option value="bank">Bank</option>
                                    <option value="cash">Cash</option>
                                    <option value="ssl">SSL</option>
                                </select>
                                @if ($errors->has('end'))
                                    <span class="text-danger"><strong>{{ $errors->first('end') }}</strong></span>
                                @endif
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3 class="card-title">Payment History</h3>
                                </div>
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Paid By</th>
                                            <th>Transaction Id</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{ $item->author->name }}</td>
                                                <td>{{ $item->transaction_id }}</td>
                                                <td>{{ $item->payment_type }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h4 class="text-center">No data found</h4>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
@endsection
