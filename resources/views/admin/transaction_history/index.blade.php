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
                    <div class="col-8">
                        <form action="{{ route('transaction.history') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
{{--                                        <div class="col-4 form-group">--}}
{{--                                            <label for="type">Status :</label>--}}
{{--                                            <select name="seller_type" id="type" class="form-control">--}}
{{--                                                <option selected disabled>Select Seller type</option>--}}
{{--                                                <option value="0" {{ Request::get('seller_type') != 1 && Request::get('user_type') != null ? 'selected' : ''}}>All Seller</option>--}}
{{--                                                <option value="1" {{ Request::get('seller_type') == 1 ? 'selected' : ''}}>Due Seller</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
                                        <div class="col-12 form-group">
                                            <label>Seller Search :</label>
                                            <input type="search" class="form-control" name="search" value="{{ Request::get('search') }}"
                                                   placeholder="Search Here by name...">
                                        </div>
                                        <div class="col-12 form-group float-right">
                                            <button type="submit" class="btn btn-primary float-right">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (count($data) > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <p> <b>Total amount :</b> {{ $total_amount }} </p>
                                <p> <b>Seller amount :</b> {{ $seller_amount }}</p>
                                <p> <b>GameHub amount :</b> {{ $gamehub_amount }}</p>
{{--                                <button id="bKash_button" class="btn btn-secondary">Pay with bKash</button>--}}

                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('transaction.export') }}" class="btn btn-primary ">Export All Transaction</a>
                            </div>
                            <div class="card-body">
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Total Amount</th>
                                            <th>Seller Amount</th>
                                            <th>commission</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key=>$item)
                                            <tr>
                                                <td><a href="{{ route('user.show', $item['id']) }}">{{ $item['name'] }} {{ $item['last_name'] }}</a></td>
                                                <td>{{ $item['total_amount']}}</td>
                                                <td>{{ $item['seller_amount'] }}</td>
                                                <td>{{ $item['original_commission'] }}</td>
                                                <td>{{ $item['seller_amount'] - $item['due'] }}</td>
                                                <td>{{ $item['due'] }}</td>
                                                <td>
                                                    <a href="{{ route('pay.amount', $item['renter_id']) }}" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i></a>
                                                    <a href="{{ route('my.lend.post', $item['renter_id']) }}" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#bKash_button').trigger('click');
            var paymentID = '';
            var bkashBaseUrl = "{{url('/admin')}}"
            bKash.init({
                paymentMode: 'checkout',
                paymentRequest: {
                    amount: 100,
                    intent: 'sale'
                },
                createRequest: function (request) {
                    let routeUrl = bkashBaseUrl + '/initiate-bkash';
                    $.ajax({
                        url: routeUrl,
                        type: 'POST',
                        data: request,
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            console.log('data logged: ', data);
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                paymentID = data.paymentID;
                                bKash.create().onSuccess(data);
                            } else {
                                bKash.create().onError();
                            }
                        },
                        error: function () {
                            bKash.create().onError();
                        }
                    });
                },
                executeRequestOnAuthorization: function () {
                    let routeUrl = bkashBaseUrl + '/confirm-bkash';
                    $.ajax({
                        url: routeUrl,
                        type: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: JSON.stringify({
                            "paymentID": paymentID
                        }),
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                console.log(data);
                                window.location.href = "{{ route('dashboard') }}";//Merchant's success page
                            } else {
                                bKash.execute().onError();
                            }
                        },
                        error: function () {
                            bKash.execute().onError();
                        }
                    });
                },
                onClose: function () {
                    alert('User has clicked the close button');
                }
            });
        })
    </script>
@endsection

