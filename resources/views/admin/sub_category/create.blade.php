@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('subcategory.store') }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>
                                @if ($errors->has('description'))
                                    <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Category</label>
                                <select name="category_id" class="form-control" required>
                                        <option value="">Select a category</option>
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <small>(Width: 1920px and Height: 600px)</small>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" name="image_url" id="coverFile" required>
                                    <label class="custom-file-label" for="coverFile">Choose file</label>
                                    <label for="productImage" class="limit-alert text-danger d-none">Image length for more than 2 mb</label>
                                    @if ($errors->has('image_url'))
                                        <span class="text-danger"><strong>{{ $errors->first('image_url') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
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
        $(document).on("change", ".custom-file-input", function() {
            var fileName = $(this).val().split("\\").pop();
            var fileSize = Math.ceil($(this)[0].files[0].size / 1024);
            if (fileSize > 2048) { //2mb
                $(this).val('');
                $(this).siblings(".limit-alert").removeClass("d-none");
                $(this).siblings(".custom-file-label").addClass("selected").html('Choose file');
                return;
            }
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            $(this).siblings(".limit-alert").addClass("d-none");
        });
    </script>
@endsection
