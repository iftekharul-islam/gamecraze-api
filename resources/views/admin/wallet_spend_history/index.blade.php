@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Wallet spend history</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Wallet spend history</li>
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
{{--                    <div class="col-8">--}}
{{--                        <form action="{{ route('wallet.history') }}">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-12 form-group">--}}
{{--                                            <label>User Search :</label>--}}
{{--                                            <input type="search" class="form-control" name="search" value="{{ Request::get('search') }}"--}}
{{--                                                   placeholder="Search Here...">--}}
{{--                                        </div>--}}
{{--                                        <div class="col-12 form-group float-right">--}}
{{--                                            <button type="submit" class="btn btn-primary float-right">Search</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    @if (count($data) > 0)
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <p> <b>Total Spend amount :</b> {{ $total_spend }} Taka</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>User name</th>
                                            <th>Spend Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key=>$item)
                                            <tr>
                                                <td><a href="{{ route('user.show', $item->id) }}"> {{ $item->name }} {{ $item->last_name }}</a></td>
                                                <td>{{ $item->amount }}</td>
                                                <td><a href="{{ route('wallet.spend.show', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-list"></i></a></td>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $data->links() }}
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

