@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Games</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Games</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    @if ($errors->has('success'))
                        <span class="help-block"><strong>{{ $errors->first('success') }}</strong></span>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">Add Game</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('game.store') }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input name="name" class="form-control" placeholder="Enter a game name..." required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('platforms') ? ' has-error' : '' }}">
                                <label for="platforms">Platforms</label>
                                <select name="platforms[]" id="platforms" class="form-control selectpicker" multiple data-live-search="true" required>
                                    @foreach($platforms as $platform)
                                        <option value="{{$platform->id}}">{{$platform->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('platform'))
                                    <span class="text-danger"><strong>{{ $errors->first('platform') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                <label for="genres">Genres</label>
                                <select name="genres[]" id="genres" class="form-control selectpicker" multiple data-live-search="true" required>
                                    @foreach($genres as $genre)
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('genre'))
                                    <span class="text-danger"><strong>{{ $errors->first('genre') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('released') ? ' has-error' : '' }}">
                                <label for="released">Release date</label>
                                <input type="date" class="form-control" id="released" name="released" placeholder="Enter Game released date" required>
                                @if ($errors->has('released'))
                                    <span class="text-danger"><strong>{{ $errors->first('released') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                                <label for="rating">Rating (Out of 100)</label>
                                <input type="number" class="form-control" id="rating" name="rating" placeholder="Enter Game rating" required>
                                @if ($errors->has('rating'))
                                    <span class="text-danger"><strong>{{ $errors->first('rating') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea class="ckeditor form-control" id="description" name="description" placeholder="Enter Description" required></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('game_modes') ? ' has-error' : '' }}">
                                <label for="game_modes">Game Mode</label>
                                <select name="game_modes[]" id="game_modes" class="form-control selectpicker" multiple data-live-search="true" required>
                                    @foreach($gameModes as $gameMode)
                                        <option value="{{$gameMode->id}}">{{$gameMode->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('platform'))
                                    <span class="text-danger"><strong>{{ $errors->first('platform') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Game image</label>
                                <input type="file" class="form-control" id="game_image" name="game_image">
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('is_trending') ? ' has-error' : '' }}">
                                <label for="is_trending">Is Trending</label><br>
                                <input type="radio" name="is_trending" value="1" checked/> Yes
                                <input type="radio" name="is_trending" value="0" /> no
                                @if ($errors->has('is_trending'))
                                    <span class="text-danger"><strong>{{ $errors->first('is_trending') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
