@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lend history</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Lend history</li>
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
        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            @if (count($data) > 0)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Order no</th>
                                        <th>Game</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Seller Amount</th>
                                        <th>Discount Amount</th>
                                        <th>commission</th>
                                        <th>Week for</th>
                                        <th>Lend date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        @php
                                            $total_amount = $item->lend_cost + $item->discount_amount + $item->commission;
                                        @endphp
                                        <tr>
                                            <td><a href="{{ route('orders.show', $item->order->id) }}">{{ $item->order->order_no ?? 'N/A'}}</a></td>
                                            <td><a href="{{ route('game.show', $item->rent->game->id) }}">{{ $item->rent->game->name }}</a></td>
                                            <td><a href="{{ route('user.show', $item->lender->id) }}">{{ $item->lender->name }}</a></td>
                                            <td>{{ $total_amount }}</td>
                                            <td>{{ $total_amount - $item->original_commission}}</td>
                                            <td>{{ $item->discount_amount ?? 0}}</td>
                                            <td>{{ $item->original_commission }}</td>
                                            <td>{{ $item->lend_week }}</td>
                                            <td>{{ $item->created_at->format('j M Y') }}</td>
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
