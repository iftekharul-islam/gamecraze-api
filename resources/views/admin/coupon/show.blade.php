@extends('layouts.app')

@section('content')
    <style>
        .card-body table tr .game-post-details-right {
            width: 75%;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Coupon details</li>
                        </ol>
                    </div>
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
        @endif<!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Coupon details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row invoice-info">
                                    <div class="col-sm-6 invoice-col border-right">
                                        <address>
                                            <strong>Name :</strong><span> {{ $data->name }}</span><br>
                                            <strong>Code :</strong><span> {{ $data->code }}</span><br>
                                            <strong>Amount :</strong><span>{{ $data->amount }}</span><br>
                                            <strong>Amount Type: </strong><span> {{ $data->amount_type == 1 ? 'Flate' : 'Percentage' }}</span><br>
                                            <strong>Limit: </strong><span> {{ $data->limit }}</span><br>
                                        </address>
                                    </div>
                                    <div class="col-sm-6 invoice-col">
                                        <address>
                                            <strong>User type :</strong><span>@isset($data->user_type) {{ $data->user_type == 1 ? 'Rookie' : 'Elite' }} @endisset</span><br>
                                            <strong>Set user :</strong><span>@isset($data->user) {{ $data->user->name }} {{ $data->user->last_name }} @endisset</span><br>
                                            <strong>Start date :</strong><span> {{ \Carbon\Carbon::parse($data->start_date)->format('j M Y') }}</span><br>
                                            <strong>End date :</strong><span> {{ \Carbon\Carbon::parse($data->end_date)->format('j M Y') }}</span><br>
                                            <strong>Status :</strong><span> {{ $data->status == 1 ? 'Active' : 'Inactive' }}</span><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

