@extends('layouts.app')

@section('content')
    <style>
        @media print {
            .callout {
                display: none;
            }
            #get {
                display: none;
            }
        }
    </style>
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
                            <div id="invoicePage">
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="far fa-address-card"></i> Lend details
                                                <small class="float-right">Date: {{ date('d F, Y', strtotime(now())) }}</small>
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
                                                <strong>{{ isset($lend->rent->user->name) ? $lend->rent->user->name : '' }}</strong><br>
                                                {{ isset($lend->rent->user->address->address) ? $lend->rent->user->address->address : '' }}<br>
                                                {{ isset($lend->rent->user->address->city) ? $lend->rent->user->address->city : '' }}<br>
                                                {{ isset($lend->rent->user->email) ? $lend->rent->user->email : '' }}<br>
                                                {{ isset($lend->rent->user->phone_number) ? $lend->rent->user->phone_number : '' }}<br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col border-right">
                                            Borrower
                                            <hr>
                                            <address>
                                                <strong>{{ isset($lend->lender->name) ? $lend->lender->name : '' }}</strong><br>
                                                {{ isset($lend->lender->address->address) ? $lend->lender->address->address : '' }}<br>
                                                {{ isset($lend->lender->address->city) ? $lend->lender->address->city : '' }}<br>
                                                {{ isset($lend->lender->email) ? $lend->lender->email : '' }}<br>
                                                {{ isset($lend->lender->phone_number) ? $lend->lender->phone_number : '' }}<br>
                                            </address>
                                        </div>
                                        <div class="col-sm-4 invoice-col">
                                            Borrow Info
                                            <hr>
                                            <address>
                                                <strong>Booking date :</strong><span> {{ date('d F,Y', strtotime($lend->lend_date)) }}</span><br>
                                                <strong>Lending Duration :</strong><span> {{ $lend->lend_week }} Week(s)</span><br>
                                               <strong>Started time:</strong><span> {{ $startDate }} </span><br>
                                               <strong>End time :</strong><span> {{ $endDate }} </span><br>
{{--                                               <strong>Lend Cost :</strong><span> {{ $lend->lend_cost }}</span><br>--}}
                                               <strong>Lend Cost :</strong><span> {{ $sum }}</span><br>
                                               <strong>Payment :</strong><span class="badge-success badge">{{ $lend->payment_method }}</span><br>
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
                                               <strong>Name :</strong><span><a href="{{ route('game.show', $lend->rent->game->id) }}"> {{ isset($lend->rent->game->name) ? $lend->rent->game->name : ''}}</a></span><br>
                                               <strong>Availability :</strong><span> {{ isset($lend->rent->availability) ? date('d F, Y', strtotime($lend->rent->availability)) : '' }}</span><br>
                                               <strong>Disk Condition :</strong><span> {{ isset($lend->rent->diskCondition->name) ? $lend->rent->diskCondition->name : '' }}</span><br>
                                               <strong>Platform :</strong><span> {{ isset($lend->rent->platform->name) ? $lend->rent->platform->name : '' }}</span><br>
                                               <div id="element"></div>
                                           </address>
                                        </div>
                                        <div class="col-sm-3 invoice-col">
                                            <div class="disk-preview disk">
                                                @if(isset($lend->rent->cover_image))
                                                    <img src="{{ asset('storage/rent-image/'. $lend->rent->cover_image) }}" id="disk-preview" class="img-thumbnail">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-3 invoice-col">
                                            <div class="cover-preview disk">
                                                @if(isset($lend->rent->disk_image))
                                                    <img src="{{ asset('storage/rent-image/'. $lend->rent->disk_image) }}" class="img-thumbnail">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <hr>
                                   
                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6">
                                            <p class="lead">Payment Methods :</p>
                                            <span class="badge-success badge">{{ isset($lend->payment_method) ? $lend->payment_method : '' }}</span>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <p class="lead">Payment details :</p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>BDT {{ $sum }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax (9.3%)</th>
                                                        <td>N/A</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Delivery Fee:</th>
                                                        <td>BDT 100</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td id="total"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12">
                                            <a href="#" class="btn-sm btn-primary" id="get"><i class="fas fa-print"></i> Print</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.invoice -->
                            </div>
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
        // var startdate = "2020/06/16",
        //     enddate = "2020/10/16";
        // if(new Date() >= new Date(startdate) && new Date() <= new Date(enddate)) {
        //     $("#element")
        //         .countdown(enddate, function(event) {
        //             $(this).text(
        //                 event.strftime('%D days %H:%M:%S')
        //             );
        //         });
        // }
        var amount = {{ $sum }} + 100;
        $('#total').html('BDT ' +amount);

        $("#get").click(function () {

            window.print();
        });
    </script>
@endsection

