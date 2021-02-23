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
                    <form id="main-form" method="post" action="{{ route('game.update', $game->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
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
                                <label for="publisher">Publisher</label>
                                <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $game->publisher }}">
                            </div>
                            <div class="form-group">
                                <label for="developer">Developer</label>
                                <input type="text" class="form-control" id="developer" name="developer" value="{{ $game->developer }}">
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating (Out of 100)</label>
                                <input type="number" class="form-control" id="rating" name="rating" value="{{ $game->rating }}">
                            </div>
                            <div class="form-group">
                                <label for="supported_language">Supported Languages</label>
                                <input type="text" class="form-control" id="supported_language" name="supported_language" value="{{ $game->supported_language }}">
                            </div>
                            <div class="form-group">
                                <label for="official_website">Official Website Link</label>
                                <input type="text" class="form-control" id="official_website" name="official_website" value="{{ $game->official_website }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="ckeditor form-control" id="mytextarea" name="description">{{ $game->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="game_image">Trending image (Width: 238px and Height: 437px)</label>
                                <input type="file" class="form-control mb-2" id="trending_url" name="trending_url" max-width="437" onchange="loadPreview(this, preview_trending);">
                                @if($game->trending_url)
                                    <img src="{{ asset($game->trending_url) }}" id="preview_trending" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_trending" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="game_image">Cover image (Width: 1920px and Height: 600px)</label>
                                <input type="file" class="form-control mb-2" id="cover_url" name="cover_url" max-width="437" onchange="loadPreview(this, preview_cover);">
                                @if($game->cover_url)
                                    <img src="{{ asset($game->cover_url) }}" id="preview_cover" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_cover" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="game_image"> Poster image (Width: 200px and Height: 300px) No file chosen</label>
                                <input type="file" class="form-control mb-2" id="poster_url" name="poster_url" max-width="437" onchange="loadPreview(this, preview_poster);">
                                @if($game->poster_url)
                                    <img src="{{ asset($game->poster_url) }}" id="preview_poster" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_poster" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="game_image">Upcoming image (Width: 250px and Height: 170px)</label>
                                <input type="file" class="form-control mb-2" id="game_image" name="upcoming_image" onchange="loadPreview(this, preview_upcoming);">

                                @if($game->upcoming_url)
                                    <img src="{{ asset($game->upcoming_url) }}" id="preview_upcoming" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_upcoming" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>
                            @if(count($game->screenshots) > 0)
                            <table class="table table-bordered mt-2" >
                                <tr>
                                    <th>Screenshots</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($game->screenshots as $item)
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <img width="50%" src="{{ asset($item->url) }}" alt="{{ $item->name }}">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteScreenshots({{ $item->id }})">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            @endif
                            <table class="table table-bordered mt-2" id="dynamicScreenshot">
                                <tr>
                                    <th>Add Screenshots</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept=".jpg,.jpeg,.png" name="screenshot_image[]" id="screenshotFile" multiple>
                                            <label class="custom-file-label" for="screenshotFile">Choose file</label>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="addScreenshot" class="btn btn-success">Add more</button>
                                    </td>
                                </tr>
                            </table>
                            @if(count($game->videoUrls) > 0)
                                <table class="table table-bordered mt-2">
                                    <tr>
                                        <th>Videos</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($game->videoUrls as $key => $url)
                                        <tr>
                                            <td>
                                            {{ $key + 1 }}. <a href="{{ $url->url }}" target="_blank">{{ $url->url }}</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" type="button" onclick="deleteVideo({{ $url->id }})">
                                                    <i class="far fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
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
                                        <button type="button" name="add" id="addVideo" class="btn btn-success">Add more</button>
                                    </td>
                                </tr>

                            </table>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('is_trending') ? ' has-error' : '' }}">
                                <label for="is_trending">Is Trending</label><br>
                                <input type="radio" name="is_trending" value="1" {{ $game->is_trending ==1 ? 'checked':'' }}/> Yes
                                <input type="radio" name="is_trending" value="0" {{ $game->is_trending ==0 ? 'checked':'' }}/> no
                                @if ($errors->has('is_trending'))
                                    <span class="text-danger"><strong>{{ $errors->first('is_trending') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('image_source') ? ' has-error' : '' }}">
                                <label for="image_source">Image Source</label>
                                <input type="text" class="form-control" id="image_source" name="image_source" value="{{ $game->image_source }}" required>
                                @if ($errors->has('image_source'))
                                    <span class="text-danger"><strong>{{ $errors->first('image_source') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
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
        function deleteScreenshots(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // document.getElementById('delete-screenshots-form-' + id).submit();
                    link = "{{ route('screenshots.destroy', ':id') }}";
                    link = link.replace(':id', id);
                    form = createForm(link);
                    form.submit();
                    swalWithBootstrapButtons.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        timer: 1500,
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Cancelled',
                        text: 'Your file is safe :)',
                        icon: 'error',
                        timer: 1500,
                    })
                }
            });
        }

        function deleteVideo(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    link = "{{ route('video.destroy', ':id') }}";
                    link = link.replace(':id', id);
                    form = createForm(link);
                    form.submit();

                    swalWithBootstrapButtons.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        timer: 1500,
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Cancelled',
                        text: 'Your file is safe :)',
                        icon: 'error',
                        timer: 1500,
                    })
                }
            });
        }

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
        $(document).on("change", ".custom-file-input", function() {
            console.log('hello');
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

        function createForm(url) {
            console.log(url)
            var form =
            $('<form>', {
                'method': 'POST',
                'action': url
            });

            var token =
            $('<input>', {
                'type': 'hidden',
                'name': '_token',
                'value': "{{ csrf_token() }}"
            });
            var hiddenInput =
            $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': 'DELETE'
            });

            return form.append(token, hiddenInput).appendTo('body');
        }
    </script>
@endsection


