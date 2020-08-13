@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Game details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Game details</li>
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
                                            <td>Name:</td>
                                            <td>{{ $game->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>{!! $game->description !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Publisher:</td>
                                            <td>{{ $game->publisher }}</td>
                                        </tr>
                                        <tr>
                                            <td>Released:</td>
                                            <td>{{ date('d F, Y', strtotime($game->released)) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mode:</td>
                                            <td>
                                                @foreach($game->gameModes as $gameMode)
                                                    <span class="badge-success badge">{{ $gameMode->name }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rating:</td>
                                            <td>{{ $game->rating }}</td>
                                        </tr>
                                        <tr>
                                            <td>Platforms:</td>
                                            <td>
                                            @foreach($game->platforms as $platform)
                                                <span class="badge-success badge">{{ $platform->name }}</span>
                                            @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Genres:</td>
                                            <td>
                                                @foreach($game->genres as $genre)
                                                    <span class="badge-success badge">{{ $genre->name }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- /.card-body -->
                        </div>
                        <div class="col-md-4 mt-4">
                            @foreach($game->assets as $asset)
                                <img src="{{ asset($asset->url) }}" id="disk-preview" class="img-thumbnail">
                            @endforeach
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
