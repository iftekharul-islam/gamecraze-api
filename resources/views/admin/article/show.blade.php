@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Article details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Article details</li>
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
                <div class="card">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Title:</td>
                                            <td>{{ $article->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>{!! $article->description !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Created At:</td>
                                            <td>{{ date('d F, Y', strtotime( $article->created_at)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{{ $article->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <div class="col-md-4 mt-4">
                                <img src="{{ asset($article->thumbnail) }}" id="disk-preview" class="img-thumbnail">
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
