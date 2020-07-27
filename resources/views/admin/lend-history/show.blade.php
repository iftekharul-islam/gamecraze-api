@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lending History</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Lend Details</li>
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
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Note:</h5>
                                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                            </div>
                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="far fa-address-card"></i> Lend details
                                            <small class="float-right">Date: {{ date(now()->format('d/m/Y')) }}</small>
                                            <hr>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col border-right">
                                        Owner<hr>
                                        <address>
                                            <strong>{{ $lend->rentPost->user->name }}</strong><br>
                                            {{ $lend->rentPost->user->address }}<br>
                                            {{ $lend->rentPost->user->email }}<br>
                                            {{ $lend->rentPost->user->phone_number }}<br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 invoice-col border-right">
                                        Renter
                                        <hr>
                                        <address>
                                            <strong>{{ $lend->lender->name }}</strong><br>
                                            {{ $lend->lender->address }}<br>
                                            {{ $lend->lender->email }}<br>
                                            {{ $lend->lender->phone_number }}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        Lend Info
                                        <hr>
                                        <address>
                                            <strong>Booked date :</strong><span> {{ $lend->lend_date }}</span><br>
                                            <strong>Lending Duration :</strong><span> {{ $lend->lend_week }} Week</span><br>
                                           <strong>Started time:</strong><span> N/A </span><br>
                                           <strong>End time :</strong><span> N/A </span><br>
                                           <strong>Lend Cost :</strong><span> {{ $lend->lend_cost }}</span><br>
                                           <strong>Payment :</strong><span> {{ $lend->payment_method }}</span><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4>
                                            <i class="fas fa-gamepad"></i> Game details
                                            <hr>
                                        </h4>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-6 invoice-col">
                                       <address>
                                           <strong>Name :</strong><span> {{ $lend->rentPost->game->name }}</span><br>
                                           <strong>Availability :</strong><span> {{ $lend->rentPost->availability }}</span><br>
                                           <strong>Disk Condition :</strong><span> {{ $lend->rentPost->diskCondition->name }}</span><br>
                                           <strong>Platform :</strong><span> {{ $lend->rentPost->platform->name }}</span><br>
                                       </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <div class="disk-preview disk">
                                            <img src="{{ asset('storage/rent-image/'. $lend->rentPost->cover_image) }}" id="disk-preview" class="img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <div class="cover-preview disk">
                                            <img src="{{ asset('storage/rent-image/'. $lend->rentPost->disk_image) }}" class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">
                                        <p class="lead">Payment Methods :</p>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead">Payment details :</p>

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>BDT {{ $lend->lend_cost }} TK</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax (9.3%)</th>
                                                    <td>N/A</td>
                                                </tr>
                                                <tr>
                                                    <th>Delivery Fee:</th>
                                                    <td>BDT 100 TK</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td id="total"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
{{--                                <div class="row no-print">--}}
{{--                                    <div class="col-12">--}}
{{--                                        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>--}}
{{--                                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
{{--                                            <i class="fas fa-download"></i> Generate PDF--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        var amount = {{ $lend->lend_cost }} + 100;
        $('#total').html('BDT ' +amount+ ' TK');
    </script>
@endsection

