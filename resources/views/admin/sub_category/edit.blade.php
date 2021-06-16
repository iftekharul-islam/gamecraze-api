@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('subcategory.update', $data->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $data->description }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select type="text" class="form-control" id="category" name="category_id">
                                    @foreach($category as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $data->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" name="image_url" id="coverFile">
                                    <label class="custom-file-label" for="coverFile">Choose file</label>
                                    <label for="productImage" class="limit-alert text-danger d-none">Image length for more than 2 mb</label>
                                    <label for="productImage" class="type-alert text-danger d-none">Image type is not valid</label>
                                    @if ($errors->has('image_url'))
                                        <span class="text-danger"><strong>{{ $errors->first('image_url') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
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
        $(document).on("change", ".custom-file-input", function() {
            let allowedTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            var fileType = $(this)[0].files[0].type;
            if (allowedTypes.indexOf(fileType) == -1) {
                $(this).val('');
                $(this).siblings(".type-alert").removeClass("d-none");
                $(this).siblings(".custom-file-label").addClass("selected").html('Choose file');
                return;
            }
            $(this).siblings(".type-alert").addClass("d-none");
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

