@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Product details</li>
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
                                            <td>Description:</td>
                                            <td>{{ $data->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Price:</td>
                                            <td>{{ $data->price }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub category:</td>
                                            <td>{{ $data->subcategory->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Product Type:</td>
                                            <td>@if($data->product_type == 1)
                                                    New
                                                @else
                                                    Used
                                                @endif
                                            </td>
                                        </tr>
                                        @if($data->product_type == 2)
                                            @if($data->used_year != null)
                                            <tr>
                                                <td>Year:</td>
                                                <td>
                                                    {{ $data->used_year }}
                                                </td>
                                            </tr>
                                            @endif
                                            @if($data->used_month != null)
                                            <tr>
                                                <td>Month:</td>
                                                <td>
                                                    {{ $data->used_month }}
                                                </td>
                                            </tr>
                                            @endif
                                            @if($data->used_day != null)
                                            <tr>
                                                <td>Day:</td>
                                                <td>
                                                    {{ $data->used_day }}
                                                </td>
                                            </tr>
                                            @endif
                                        @endif
                                        <tr>
                                            <td>Location:</td>
                                            <td>{{ $data->thana->name }}, {{ $data->thana->district->name }},  {{ $data->thana->district->division->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Area:</td>
                                            <td>{{ $data->area }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td>{{ $data->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone no:</td>
                                            <td>{{ $data->phone_no ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td>{{ $data->address ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Is Negotiable:</td>
                                            <td>@if($data->is_negotiable == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Is sold:</td>
                                            <td>@if($data->is_sold == 1)
                                                    Available
                                                @else
                                                    Sold
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Created at:</td>
                                            <td>{{ date('d F, Y', strtotime($data->created_at)) }}</td>
                                        </tr>
                                        @if($data->reason != null)
                                            <tr>
                                                <td>Reject reason:</td>
                                                <td>{{ $data->reason }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Cover image:</td>
                                            <td>
                                                @foreach( $coverImages as $cover)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="{{ asset('storage/' . $cover->id . '/' . $cover->file_name) }}" id="disk-preview" class="img-thumbnail">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Image:</td>
                                            <td>
                                                @foreach( $images as $image)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <img src="{{ asset('storage/' . $image->id . '/' . $image->file_name) }}" id="disk-preview" class="img-thumbnail">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </td>
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
@section('js')
@endsection
