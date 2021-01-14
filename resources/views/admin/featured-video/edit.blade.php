@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Video</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Video</li>
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
                        <h3 class="card-title">Update Video</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('video.update', $video->id) }}" enctype="multipart/form-data"
                          class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="name">Title</label>
                                    <input name="title" class="form-control" placeholder="Enter a title..." value="{{ $video->title }}" required>
                                    @if ($errors->has('title'))
                                        <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                    @endif
                                </div>

                                <div class="false-padding-bottom-form form-group{{ $errors->has('video_url') ? ' has-error' : '' }}">
                                    <label for="name">Video URL</label>
                                    <input name="video_url" class="form-control" placeholder="Enter URL" value="{{ $video->video_url }}" required>
                                    @if ($errors->has('video_url'))
                                        <span class="text-danger"><strong>{{ $errors->first('video_url') }}</strong></span>
                                    @endif
                                </div>

                                <div class="false-padding-bottom-form form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="name">Is Featured</label>
                                    <select name="is_featured" class="form-control select2">
                                        <option value="0" @if($video->is_featured == 0) selected @endif>No</option>
                                        <option value="1" @if($video->is_featured == 1) selected @endif>Yes</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger"><strong>{{ $errors->first('status') }}</strong></span>
                                    @endif
                                </div>
                                <div class="false-padding-bottom-form form-group">
                                    <button type="submit" class="btn btn-primary btn-submit">Update</button>
                                </div>
                            </div>
                            
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
    </script>
@endsection
