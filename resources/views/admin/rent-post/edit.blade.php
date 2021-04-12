@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Lend Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Lend Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row invoice-info">
                                        <div class="col-sm-6 border-right">
                                            Lend Poster<hr>
                                            <address>
                                                <strong>{{ isset($data->user->name) ? $data->user->name : '' }}</strong><br>
                                                {{ isset($data->user->address->address) ? $data->user->address->address : '' }}<br>
                                                {{ isset($data->user->address->city) ? $data->user->address->city : '' }}<br>
                                                {{ isset($data->user->email) ? $data->user->email : '' }}<br>
                                                {{ isset($data->user->phone_number) ? $data->user->phone_number : '' }}<br>
                                                <hr>
                                                @isset($data->game_user_id) <strong>Game User ID :</strong><span> {{ $data->game_user_id }}</span><br> @endisset
                                                @isset($data->game_password) <strong>Game Password :</strong><span> {{ $data->game_password }}</span><br> @endisset
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6 invoice-col">
                                            Rent details
                                            <hr>
                                            <strong>Name :</strong>
                                            <span>
                                                <a href="{{ route('game.show', $data->game->id) }}"> {{ isset($data->game->name) ? $data->game->name : ''}}</a>
                                            </span><br>
                                            <strong>Disk type :</strong><span class="badge badge-primary"> {{ $data->disk_type == 0 ? 'Digital Copy' : 'Physical Copy'}}</span><br>
                                            @if($data->disk_type == 1)
                                                <strong>Disk condition :</strong><span> {{ $data->diskCondition->name ?? '' }} ({{ $data->diskCondition->description ?? '' }})</span><br>
                                            @endif
                                            <strong>Max Rent Week :</strong><span> {{ $data->max_week }}</span><br>
                                            <strong>Game Base Price :</strong><span> {{ $data->game->basePrice->base }}</span><br>
                                            <strong>Delivery :</strong><span> {{ $data->checkpoint ?  $data->checkpoint->name : 'COD' }}</span><br>
                                            <strong>Developer :</strong><span> {{ $data->game->developer }}</span><br>
                                        <!-- /.col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- form start -->
                            <form id="main-form" method="post" action="{{ route('rentPost.update', $data->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="week">Lend Max Week</label>
                                <input type="text" class="form-control" id="week" name="max_week" value="{{ $data->max_week }}">
                            </div>
                            <div class="form-group">
                                <label for="platforms">Platforms</label>
                                <select name="platform_id" class="form-control selectpicker" data-live-search="true">
                                    @foreach($platforms as $platform)

                                        <option value="{{ $platform->id }}" {{ $data->platform_id == $platform->id ? 'selected' : ''}}>{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cover_image">Cover image</label>
                                <input type="file" class="form-control mb-2" id="cover_image" name="cover_image" max-width="437" onchange="loadPreview(this, preview_cover);">
                                @if($data->cover_image)
                                    <img src="{{ asset('storage/rent-image/'. $data->cover_image) }}" id="preview_cover" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_cover" class="img-thumbnail" width="200" height="150" >
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="disk_image">Disk image</label>
                                <input type="file" class="form-control mb-2" id="disk_image" name="disk_image" max-width="437" onchange="loadPreview(this, preview_disk);">
                                @if($data->disk_image)
                                    <img src="{{ asset('storage/rent-image/'. $data->disk_image) }}" id="preview_disk" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('storage/game-image/dummy-image.jpg') }}" id="preview_disk" class="img-thumbnail" width="200" height="150">
                                @endif
                            </div>

                        <div class="card-body">
                            <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    </form>
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- /.container-fluid -->

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
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


