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
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
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
                                            <td>{{ $lend->lender->name}}</td>
                                            <td>
                                                {{ $lend->rent->user->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('lend.show', $lend->id) }}">
                                                    {{ $lend->rent->game->name }}
                                                </a>
                                            </td>
                                            <td>{{ $lend->lend_date }}</td>
                                            <td>
                                                @if ($lend->status === 0)
                                                    <a class="badge-info badge text-white">On lending</a>
                                                @elseif ($lend->status === 1)
                                                    <a class="badge-success badge text-white">Lending complete</a>
                                                @elseif ($lend->status === 2)
                                                    <a class="badge-danger badge text-white">Stolen by lender</a>
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

