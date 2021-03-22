@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Article</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Article</li>
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
                        <h3 class="card-title">Add Article</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data"
                          class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name">Title</label>
                                <input name="title" class="form-control" placeholder="Enter a title..." required>
                                @if ($errors->has('title'))
                                    <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea class="ckeditor form-control" id="description" name="description"
                                          placeholder="Enter Description" required></textarea>
                                @if ($errors->has('description'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <label for="thumbnail">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="thumbnail" id="thumbnailFile" required>
                                <label class="custom-file-label" for="thumbnailFile">Choose file</label>
                                @if ($errors->has('thumbnail'))"
                                    <span class="text-danger"><strong>{{ $errors->first('thumbnail') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name">Status</label>
                                <select name="status" class="form-control select2">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger"><strong>{{ $errors->first('status') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name">Is Featured</label>
                                <select name="is_featured" class="form-control select2">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger"><strong>{{ $errors->first('status') }}</strong></span>
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
    </script>
@endsection
