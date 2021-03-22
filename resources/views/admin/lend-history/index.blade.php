@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lending history</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Lend history</li>
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
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (count($lends) > 0)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order No</th>
                                        <th>Game owner</th>
                                        <th>Borrower</th>
                                        <th>Rented Game</th>
                                        <th>Lending date</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lends as $key=>$lend)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ isset($lend->order) ? $lend->order->order_no : '' }}</td>
                                            <td>{{ isset($lend->lender->name) ? $lend->lender->name : '' }}</td>
                                            <td>
                                                {{ isset($lend->rent->user->name) ? $lend->rent->user->name : '' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('lend.show', $lend->id) }}">
                                                    {{ isset($lend->rent->game->name) ? $lend->rent->game->name : '' }}
                                                </a>
                                            </td>
                                            <td>{{ date('d F Y', strtotime($lend->lend_date)) }}</td>
                                            <td>
                                                @if ($lend->status === 0)
                                                    <a class="badge-info badge text-white">Pending</a>
                                                @elseif ($lend->status === 1)
                                                    <a class="badge-success badge text-white">Lending complete</a>
                                                @elseif ($lend->status === 2)
                                                    <a class="badge-danger badge text-white">arrived at checkpoint</a>
                                                @elseif ($lend->status === 3)
                                                    <a class="badge-danger badge text-white">Delivered</a>
                                                @elseif ($lend->status === 4)
                                                    <a class="badge-danger badge text-white">Rejected</a>
                                                @elseif ($lend->status === 5)
                                                    <a class="badge-danger badge text-white">Processing</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary mr-3" href="{{ route('lend.show', $lend->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </td>
{{--                                            <td>--}}
{{--                                                <a class="btn btn-sm btn-primary mr-3"--}}
{{--                                                   href="{{ route('game.edit', $game->id) }}"><i--}}
{{--                                                        class="far fa-edit"></i></a>--}}
{{--                                                <a href="{{ route('rentPost.show', $rent->id) }}" class="btn btn-primary btn-sm">--}}
{{--                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>--}}
{{--                                                <button class="btn btn-danger btn-sm" type="button"--}}
{{--                                                        onclick="deletePost({{ $rent->id }})">--}}
{{--                                                    <i class="far fa-trash-alt"></i></button>--}}
{{--                                                <form id="delete-form-{{ $rent->id }}"--}}
{{--                                                      action="{{ route('rentPost.destroy', $rent->id) }}"--}}
{{--                                                      method="post" class="d-none">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

