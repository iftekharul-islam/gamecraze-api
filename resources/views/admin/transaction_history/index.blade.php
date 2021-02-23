@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaction history</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Transaction history</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Customer amount</th>
                                            <th>commission</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key=>$item)
                                            @foreach($paid_amount as $amount)
                                                @php $paid = 0; @endphp
                                                @if ($item->renter_id == $amount->user_id)
                                                    @php $paid =  $amount->paid_amount @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->commission }}</td>
                                                <td>{{ $paid }}</td>
                                                <td>{{ $item->amount + $item->commission - $paid }}</td>
                                                <td>
                                                    <a href="{{ route('pay.amount', $item->renter_id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i></a>
                                                    <a href="{{ route('my.lend.post', $item->renter_id) }}" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a>
                                                </td>
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
