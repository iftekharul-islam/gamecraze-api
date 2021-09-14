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
                    <form method="post" action="{{ route('game.store') }}" enctype="multipart/form-data"
                          class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label> <label for="name" class="text-danger">*</label>
                                <input name="name" class="form-control" placeholder="Enter a game name..." required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('platforms') ? ' has-error' : '' }}">
                                <label for="platforms">Platforms</label><label for="platforms" class="text-danger">*</label>
                                @if (count($platforms) > 0)
                                    <select name="platforms[]" id="platforms" class="form-control selectpicker" multiple
                                            data-live-search="true" required>
                                        @foreach($platforms as $platform)
                                            <option value="{{$platform->id}}">{{$platform->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger"
                                           value="Please fill the platform table first !!!" disabled>
                                @endif
                                @if ($errors->has('platform'))
                                    <span class="text-danger"><strong>{{ $errors->first('platform') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('genre') ? ' has-error' : '' }}">
                                <label for="genres">Genres</label><label for="genres" class="text-danger">*</label>
                                @if (count($genres) > 0)
                                    <select name="genres[]" id="genres" class="form-control selectpicker" multiple
                                            data-live-search="true" required>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger"
                                           value="Please fill the Genres table first !!!" disabled>
                                @endif
                                @if ($errors->has('genre'))
                                    <span class="text-danger"><strong>{{ $errors->first('genre') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('released') ? ' has-error' : '' }}">
                                <label for="released">Release date</label><label for="released" class="text-danger">*</label>
                                <input type="date" class="form-control" id="released" name="released"
                                       placeholder="Enter Game released date" required>
                                @if ($errors->has('released'))
                                    <span class="text-danger"><strong>{{ $errors->first('released') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('publisher') ? ' has-error' : '' }}">
                                <label for="publisher">Publisher</label><label for="publisher" class="text-danger">*</label>
                                <input type="text" class="form-control" id="publisher" name="publisher"
                                       placeholder="Enter Game publisher" required>
                                @if ($errors->has('publisher'))
                                    <span class="text-danger"><strong>{{ $errors->first('publisher') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('developer') ? ' has-error' : '' }}">
                                <label for="developer">Developer</label><label for="developer" class="text-danger">*</label>
                                <input type="text" class="form-control" id="developer" name="developer"
                                       placeholder="Enter Game developer" required>
                                @if ($errors->has('developer'))
                                    <span class="text-danger"><strong>{{ $errors->first('developer') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                                <label for="rating">Rating (Out of 100)</label><label for="rating" class="text-danger">*</label>
                                <input type="number" class="form-control" id="rating" name="rating"
                                       placeholder="Enter Game rating" required>
                                @if ($errors->has('rating'))
                                    <span class="text-danger"><strong>{{ $errors->first('rating') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('supported_language') ? ' has-error' : '' }}">
                                <label for="supported_language">Supported Languages</label><label for="developer" class="text-danger">*</label>
                                <input type="text" class="form-control" id="supported_language" name="supported_language"
                                       placeholder="Enter Game supported languages" required>
                                @if ($errors->has('supported_language'))
                                    <span class="text-danger"><strong>{{ $errors->first('supported_language') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('official_website') ? ' has-error' : '' }}">
                                <label for="official_website">Official Website Link</label><label for="official_website" class="text-danger">*</label>
                                <input type="text" class="form-control" id="official_website" name="official_website"
                                       placeholder="Enter Game official website" required>
                                @if ($errors->has('official_website'))
                                    <span class="text-danger"><strong>{{ $errors->first('official_website') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label><label for="description" class="text-danger">*</label>
                                <textarea class="form-control ckeditor" id="description" name="description"
                                          placeholder="Enter Description" required></textarea>
                                @if ($errors->has('description'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('base_price_id') ? ' has-error' : '' }}">
                                <label for="price">Base Price</label><label for="price" class="text-danger">*</label>
                                @if(count($basePrices) > 0)
                                    <select name="base_price_id" id="base_price_id" class="form-control selectpicker"
                                            data-live-search="true" required>
                                        @foreach($basePrices as $basePrice)
                                            <option value="{{$basePrice->id}}">{{$basePrice->start}}
                                                - {{$basePrice->end}} = {{$basePrice->base}} (BDT)
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger"
                                           value="Please fill the base price table first !!!" disabled>
                                @endif
                                @if ($errors->has('base_price_id'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('base_price_id') }}</strong></span>
                                @endif
                            </div>
                            <label>Trending image</label>
                            <small>(Width: 238px and Height: 437px)</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="trending_url" id="trendingFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @if ($errors->has('trending_url'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('trending_url') }}</strong></span>
                                @endif
                            </div>
                            <label>Cover image</label>
                            <small>(Width: 1920px and Height: 600px)</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cover_url" id="coverFile">
                                <label class="custom-file-label" for="coverFile">Choose file</label>
                                @if ($errors->has('cover_url'))
                                    <span class="text-danger"><strong>{{ $errors->first('cover_url') }}</strong></span>
                                @endif
                            </div>
                            <label>Poster image</label>
                            <small>(Width: 200px and Height: 300px)</small>
                            <div class="custom-file">
{{--                                <input type="file" class="form-control" id="poster_image" name="poster_url">--}}
                                <input type="file" class="custom-file-input" name="poster_url" id="posterFile">
                                <label class="custom-file-label" for="posterFile">Choose file</label>
                                @if ($errors->has('poster_url'))
                                    <span class="text-danger"><strong>{{ $errors->first('poster_url') }}</strong></span>
                                @endif
                            </div>
                            <label>Upcoming image</label>
                            <small>(Width: 250px and Height: 170px)</small>
                            <div class="custom-file">
                                <input type="file" multiple="multiple" class="custom-file-input" name="upcoming_image" id="gameFile">
                                <label class="custom-file-label" for="gameFile">Choose file</label>
                                @if ($errors->has('upcoming_image'))
                                    <span class="text-danger"><strong>{{ $errors->first('upcoming_image') }}</strong></span>
                                @endif
                            </div>
                            <table class="table table-bordered mt-2" id="dynamicScreenshot">
                                <tr>
                                    <th>Add Screenshot</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="screenshot_image[]" id="screenshotFile">
                                            <label class="custom-file-label" for="screenshotFile">Choose file</label>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="addScreenshot" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-2" id="dynamicVideos">
                                <tr>
                                    <th>Add Videos</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="video_url[]" id="videoFile">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="addVideo" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>

                            </table>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('is_trending') ? ' has-error' : '' }}">
                                <label for="is_trending">Is Trending</label><br>
                                <input type="radio" name="is_trending" value="1" checked/> Yes
                                <input type="radio" name="is_trending" value="0"/> No
                                @if ($errors->has('is_trending'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('is_trending') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('image_source') ? ' has-error' : '' }}">
                                <label for="image_source">Image Source</label><label for="image_source" class="text-danger">*</label>
                                <input type="text" class="form-control" id="image_source" name="image_source"
                                       placeholder="Enter image source name" required>
                                @if ($errors->has('image_source'))
                                    <span class="text-danger"><strong>{{ $errors->first('image_source') }}</strong></span>
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
        $(document).on("change", ".custom-file-input", function() {
            var fileName = $(this).val().split("\\").pop();
            console.log(fileName);
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var i = 0;
        var j = 0
        $(document).on('click', "#addScreenshot", function(){
            ++i;
            $("#dynamicScreenshot").append('<tr><td><div class="custom-file"><input type="file" class="custom-file-input" id="screenshotFile-'+i+'" name="screenshot_image[]"><label class="custom-file-label" for="screenshotFile-'+i+'">Choose file</label></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', "#addVideo", function(){
            ++j;
            $("#dynamicVideos").append('<tr><td><div class="form-group"><input type="text" class="form-control" id="videoFile-'+j+'" name="video_url[]"><label class="custom-file-label" for="videoFile-'+i+'">Choose file</label></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
@endsection
