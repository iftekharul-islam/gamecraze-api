@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                        <h3 class="card-title">Add product</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" class="w-75 mx-auto">
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
                                <textarea class="form-control ckeditor" id="description" name="description"
                                          placeholder="Enter Description" required></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                                @if ($errors->has('price'))
                                    <span class="text-danger"><strong>{{ $errors->first('price') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('is_trending') ? ' has-error' : '' }}">
                                <label for="product_type">Product type</label><br>
                                <input type="radio" name="product_type" onclick="setSummary(this)" value="1" id="typeRadios1" checked/>
                                <label class="form-check-label" for="typeRadios1">
                                    New
                                </label>
                                <input type="radio" name="product_type" onclick="setSummary(this)" id="typeRadios2" value="2"/>
                                <label class="form-check-label" for="typeRadios2">
                                    Used
                                </label>
                                @if ($errors->has('product_type'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('product_type') }}</strong></span>
                                @endif
                            </div>
                            <div class="summary d-none false-padding-bottom-form form-group{{ $errors->has('condition_summary') ? ' has-error' : '' }}">
                                <label for="summary">Condition summary</label>

                                <input type="text" class="form-control product-condition"
                                       id="summary"
                                       name="condition_summary"
                                       maxlength="300"
                                       placeholder="Enter product condition, purchase date or warranty details">

                                @if ($errors->has('condition_summary'))
                                    <span class="text-danger"><strong>{{ $errors->first('condition_summary') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('is_negotiable') ? ' has-error' : '' }}">
                                <input type="checkbox" name="is_negotiable" id="is_negotiable" value=""/>
                                <label for="is_negotiable">Is Negotiable</label><br>
                                @if ($errors->has('is_negotiable'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('is_negotiable') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('phone_no') ? ' has-error' : '' }}">
                                <label for="phone">Phone no</label>
                                <input type="number" class="form-control" id="phone" name="phone_no" placeholder="Enter phone no" required>
                                @if ($errors->has('phone_no'))
                                    <span class="text-danger"><strong>{{ $errors->first('phone_no') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" maxlength="300" required>
                                @if ($errors->has('address'))
                                    <span class="text-danger"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Sub Category</label>
                                <select name="sub_category_id" class="form-control selectpicker" required>
                                        <option value="">Select a sub category</option>
                                    @foreach($subcategory as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Product for Customer</label>
                                <select name="user_id" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Select a customer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <table class="table table-bordered mt-2" id="dynamicProductImage">
                                <tr>
                                    <th>Add Product Image</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" name="product_image[]" id="productImage" required>
                                            <label class="custom-file-label" for="productImage">Choose file</label>
                                            <label for="productImage" class="limit-alert text-danger d-none">Image length for more than 2 mb</label>
                                            <label for="productImage" class="type-alert text-danger d-none">Image type is not valid</label>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="addProductImage" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>
                            </table>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
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
        function setSummary(){
            var type = $('input[name="product_type"]:checked').val();
            $('.summary').addClass('d-none');
            $('#summary').prop('required', false);
            if (type == 2){
                $('.summary').removeClass('d-none');
                $('#summary').prop('required', true);
            } else {
                $('#summary').val('');
            }
        }
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
            console.log('fileSize');
            console.log(fileSize);
            if (fileSize > 2048) { //2mb
                $(this).val('');
                $(this).siblings(".limit-alert").removeClass("d-none");
                $(this).siblings(".custom-file-label").addClass("selected").html('Choose file');
                return;
            }
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            $(this).siblings(".limit-alert").addClass("d-none");

        });
        var i = 0;
        $(document).on('click', "#addProductImage", function(){
            ++i;
            $("#dynamicProductImage").append('<tr><td><div class="custom-file"><input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" id="productImage-'+i+'" name="product_image[]" required><label class="custom-file-label" for="productImage-'+i+'">Choose file</label><label for="productImage'+i+'" class="limit-alert text-danger d-none">Image length for more than 2 mb</label><label for="productImage" class="type-alert text-danger d-none">Image type is not valid</label></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
@endsection
