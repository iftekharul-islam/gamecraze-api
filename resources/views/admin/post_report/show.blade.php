@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Report details</li>
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width: 200px">Name:</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone no:</td>
                                        <td>{{ $data->phone_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>email:</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Product name : </td>
                                        <td>
                                            <a href="{{ route('product.show', $data->product_id) }}">{{ $data->product->name }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Report summary:</td>
                                        <td>
                                            {{ $data->reason }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Created at:</td>
                                        <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
