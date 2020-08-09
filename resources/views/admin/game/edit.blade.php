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
                    <form method="post" action="{{ route('game.update', $game->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $game->name }}">
                            </div>
                            <div class="form-group">
                                <label for="genres">Genres</label>
                                <select name="genres[]" class="form-control selectpicker" multiple data-live-search="true">
                                    @foreach($genres as $genre)
                                        @foreach($game->genres as $gen)
                                            @if($gen->id == $genre->id)
                                                <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                                                <?php continue 2; ?>
                                            @endif
                                        @endforeach
                                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="platforms">Platforms</label>
                                <select name="platforms[]" class="form-control selectpicker" multiple data-live-search="true">
                                    @foreach($platforms as $platform)
                                        @foreach($game->platforms as $plat)
                                            @if($plat->id == $platform->id)
                                                <option value="{{ $platform->id }}" selected>{{ $platform->name }}</option>
                                                <?php continue 2; ?>
                                            @endif
                                        @endforeach
                                            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="released">Release date</label>
                                <input type="date" class="form-control" id="released" name="released" value="{{ $game->released }}">
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating (Out of 10)</label>
                                <input type="number" class="form-control" id="rating" name="rating" value="{{ $game->rating }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="ckeditor form-control" id="mytextarea" name="description">{{ $game->description }}</textarea>

                            </div>
                            <div class="form-group">
                                <label for="game_mode">Game Mode</label>
                                <select name="game_modes[]" class="form-control selectpicker" multiple data-live-search="true">
                                    @foreach($modes as $mode)
                                        @foreach($game->gameModes as $gameMode)
                                            @if($mode->id == $gameMode->id)
                                                <option value="{{ $gameMode->id }}" selected>{{ $gameMode->name }}</option>
                                                <?php continue 2; ?>
                                            @endif
                                        @endforeach
                                        <option value="{{ $mode->id }}">{{ $mode->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="game_image">Game image</label>
                                <input type="file" class="form-control mb-2" id="game_image" name="game_image" onchange="loadPreview(this);">
                                @if(count($game->assets)>0)
                                    @foreach($game->assets as $asset)
                                        <img src="{{ asset($asset->url) }}" id="preview_img" class="img-thumbnail" width="200" height="150">
                                    @endforeach
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_img" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('is_trending') ? ' has-error' : '' }}">
                                <label for="is_trending">Is Trending</label><br>
                                <input type="radio" name="is_trending" value="1" {{ $game->is_trending ==1 ? 'checked':'' }}/> Yes
                                <input type="radio" name="is_trending" value="0" {{ $game->is_trending ==0 ? 'checked':'' }}/> no
                                @if ($errors->has('is_trending'))
                                    <span class="text-danger"><strong>{{ $errors->first('is_trending') }}</strong></span>
                                @endif
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
@section('js')
    <script>
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(id)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection


