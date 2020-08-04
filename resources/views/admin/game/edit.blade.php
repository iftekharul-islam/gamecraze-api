@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Game</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Game</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="{{ route('game.update', $game->id) }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $game->name }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Release date</label>
                                <input type="date" class="form-control" id="released" name="released" value="{{ $game->released }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Rating (Out of 10)</label>
                                <input type="number" class="form-control" id="rating" name="rating" value="{{ $game->rating }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $game->description }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Game Mode</label>
                                <input type="text" class="form-control" id="game_mode" name="game_mode" value="{{ $game->game_mode }}">
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

