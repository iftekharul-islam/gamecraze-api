@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Referral history</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Referral history</li>
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
                        <form action="{{ route('referral.history') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label>Start date :</label>
                                            <input type="date" class="form-control" name="start_date" value="{{ Request::get('start_date') ?? '' }}">
                                        </div>
                                        <div class="col-6 form-group">
                                            <label>End date :</label>
                                            <input type="date" class="form-control" name="end_date" value="{{ Request::get('end_date') ?? '' }}">
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
                                <p> <b>Total Earning amount :</b> {{ $total_earning }} Taka</p>
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
                                            <th>Referred By</th>
                                            <th>Referred To</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $key=>$item)
                                            <tr>
                                                <td><a href="{{ route('user.show', $item->id) }}">@isset($item->user) {{ $item->user->name }} {{ $item->user->last_name }} @endisset</a></td>
                                                <td><a href="{{ route('user.show', $item->id) }}">@isset($item->referredUser) {{ $item->referredUser->name }} {{ $item->referredUser->last_name }} @endisset</a></td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->created_at->format('j M Y') }}</td>
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

