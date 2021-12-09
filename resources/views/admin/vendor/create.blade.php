@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vendor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Vendor</li>
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
                        <h3 class="card-title">Add Vendor</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('vendor.store') }}" enctype="multipart/form-data"
                          class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('shop_name') ? ' has-error' : '' }}">
                                <label for="name">Shop Name</label> <label for="name" class="text-danger">*</label>
                                <input name="shop_name" class="form-control" placeholder="Enter a shop name..." required>
                                @if ($errors->has('shop_name'))
                                    <span class="text-danger"><strong>{{ $errors->first('shop_name') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('trade_license') ? ' has-error' : '' }}">
                                <label for="released">Trade license</label><label for="released" class="text-danger">*</label>
                                <input type="text" class="form-control" maxlength="6" id="released"  name="trade_license"
                                       placeholder="Enter Game released date" required>
                                @if ($errors->has('trade_license'))
                                    <span class="text-danger"><strong>{{ $errors->first('trade_license') }}</strong></span>
                                @endif
                            </div>
                            <div
                                class="false-padding-bottom-form form-group{{ $errors->has('shop_description') ? ' has-error' : '' }}">
                                <label for="description">Shop description</label><label for="description" class="text-danger">*</label>
                                <textarea class="form-control ckeditor" id="description" name="shop_description" required></textarea>
                                @if ($errors->has('shop_description'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('shop_description') }}</strong></span>
                                @endif
                            </div>
                            <label>Profile image</label>
                            <small>(Width: 200px and Height: 200px)</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="profile_photo" id="coverFile" required>
                                <label class="custom-file-label" for="coverFile">Choose file</label>
                                @if ($errors->has('profile_photo'))
                                    <span class="text-danger"><strong>{{ $errors->first('profile_photo') }}</strong></span>
                                @endif
                            </div>
                            <label>Cover Image</label>
                            <small>(Width: 2:1)</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cover_photo" id="trendingFile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                @if ($errors->has('cover_photo'))
                                    <span
                                        class="text-danger"><strong>{{ $errors->first('cover_photo') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <table class="table table-bordered mt-2" id="dynamicScreenshot">
                                <tr>
                                    <th>Add Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-file">
                                            <input type="number" class="form-control" name="phone_number[]" id="screenshotFile">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="addScreenshot" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-2" id="dynamicVideos">
                                <tr>
                                    <th>Add Address</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter address type (Shop/ Warehouse/Service center)" name="titles[]" id="videoFile">
                                            <input type="text" class="form-control" placeholder="Enter address" name="addresses[]" id="videoFile">
                                            <input type="text" class="form-control" placeholder="Ente your state" name="states[]" id="videoFile">
                                            <input type="text" class="form-control" placeholder="Ente your city" name="cities[]" id="videoFile">
                                            <input type="text" class="form-control" placeholder="Ente your zip code" name="zips[]" id="videoFile">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" id="addVideo" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>

                            </table>
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
            $("#dynamicScreenshot").append('<tr><td><div class="custom-file"><input type="number" max="11" class="form-control" id="screenshotFile-'+i+'" name="phone_number[]"></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', "#addVideo", function(){
            ++j;
            $("#dynamicVideos").append('<tr><td><div class="form-group"><input type="text" class="form-control" id="videoFile-'+j+'" placeholder="Enter address type (Shop/ Warehouse/Service center)" name="titles[]"><input type="text" class="form-control" id="videoFile-'+j+'"  placeholder="Enter address" name="addresses[]"><input type="text" class="form-control" id="videoFile-'+j+'" placeholder="Ente your state" name="states[]"><input type="text" class="form-control" id="videoFile-'+j+'" placeholder="Ente your city" name="cities[]"><input type="text" class="form-control" id="videoFile-'+j+'" placeholder="Ente your zip code" name="zips[]"></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
@endsection
