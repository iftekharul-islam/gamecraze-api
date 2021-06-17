@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Orders history</li>
                        </ol>
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
                @endif
            </div>
        <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('orders.all') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 form-group">
                                            <label for="status">Status :</label>
                                            <select name="status" class="form-control">
                                                <option selected disabled>Select status</option>
                                                <option value="">All Order</option>
                                                @foreach(config('gamehub.order_delivery_status') as $key => $status)
                                                    <option value="{{$key}}" {{ Request::get('status') == $key && Request::get('status') != null? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-8 form-group">
                                            <label>Order Search :</label>
                                            <input type="search" class="form-control" name="search" value="{{ Request::get('search') }}"
                                                   placeholder="Search Here...">
                                        </div>
                                        <div class="col-6-xxxl col-lg-6 col-6 form-group">
                                            <label>Start date</label>
                                            <input name="start_date" type="date" class="form-control" value="{{ Request::get('start_date') ?? '' }}">
                                        </div>
                                        <div class="col-6-xxxl col-lg-6 col-6 form-group">
                                            <label>End date</label>
                                            <input name="end_date" type="date" class="form-control" value="{{ Request::get('end_date') ?? '' }}">
                                        </div>
                                        <div class="col-12 form-group float-right">
                                            <button type="submit" class="btn btn-primary float-right">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($orders->isNotEmpty())
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Order No</th>
                                        <th>Lender Name</th>
                                        <th>Amount</th>
                                        <th>Create Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $key => $order)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $order->order_no }}</td>
                                            <td><a href="{{ route('user.show', $order->user->id) }}">{{ $order->user->name }} {{ $order->user->last_name }}</a></td>
                                            <td>{{ $order->amount }}</td>
                                            <td>{{ $order->created_at->format('j M Y') }}</td>
                                            <td>{{ isset($order->end_date) ? \Carbon\Carbon::parse($order->end_date)->format('j M Y') : '-' }}</td>
                                            <td>{{ ucfirst(getOrderDeliveryStatus($order->delivery_status)) }}</td>
                                            <td>{{ $order->payment_status == 1 ? 'Paid' : 'Unpaid' }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary mr-3" href="{{ route('orders.show', $order->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{ $orders->appends(Request::all())->links() }}
                                </div>
                                
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

