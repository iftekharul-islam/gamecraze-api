@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                    <form method="post" action="{{ route('product.update', $data->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                          placeholder="Enter Description">{{ $data->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $data->price }}">
                            </div>
                            <div class="form-group">
                                <label for="category">Sub Category</label>
                                <select type="text" class="form-control" id="category" name="sub_category_id">
                                    @foreach($subcategory as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $data->sub_category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Product for Customer</label>
                                <select name="user_id" class="form-control selectpicker" data-live-search="true" required>
                                    <option value="">Select a customer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $data->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_type">Product type</label><br>
                                <input type="radio" name="product_type" onclick="setSummary(this)" value="1" id="typeRadios1" {{ $data->product_type == 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="typeRadios1">
                                    New
                                </label>
                                <input type="radio" name="product_type" onclick="setSummary(this)" id="typeRadios2" value="2" {{ $data->product_type == 2 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="typeRadios2">
                                    Used
                                </label>
                            </div>
                            <div class="summary d-none row">
{{--                                <div class="col-md-12 form-group">--}}
{{--                                    <label for="summary">Condition summary</label>--}}

{{--                                    <input type="text" class="form-control product-condition"--}}
{{--                                           id="summary"--}}
{{--                                           name="condition_summary"--}}
{{--                                           maxlength="300"--}}
{{--                                           value="{{ $data->condition_summary }}"--}}
{{--                                           placeholder="Enter product condition, purchase date or warranty details">--}}

{{--                                </div>--}}
                                <div class="col-md-4 false-padding-bottom-form form-group{{ $errors->has('used_year') ? ' has-error' : '' }}">
                                    <label>Used year</label>

                                    <select name="used_year" class="form-control">
                                        <option value="">Select a year</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $data->used_year == $i ? 'selected' : '' }}>{{ $i }} year</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('used_year'))
                                        <span class="text-danger"><strong>{{ $errors->first('used_year') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-4 false-padding-bottom-form form-group">
                                    <label>Used month</label>
                                    <select name="used_month" class="form-control">
                                        <option value="">Select a month</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $data->used_month == $i ? 'selected' : '' }}>{{ $i }} month</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 false-padding-bottom-form form-group">
                                    <label>Used day</label>
                                    <select name="used_day" class="form-control">
                                        <option value="">Select a day</option>
                                        @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}" {{ $i == $data->used_day  ? 'selected' : '' }}>{{ $i }} day</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('used_day'))
                                        <span class="text-danger"><strong>{{ $errors->first('used_day') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('warranty_availability') ? ' has-error' : '' }}">
                                <label>Product Warranty available ?</label><br>
                                <input type="radio" name="warranty_availability" onclick="setWarranty()" value="1" id="warrantyRadios2" {{ $data->warranty_availability == 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="warrantyRadios2">
                                    Yes
                                </label>
                                <input type="radio" name="warranty_availability" onclick="setWarranty()" value="2" id="warrantyRadios1" {{ $data->warranty_availability == 2 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="warrantyRadios1">
                                    No
                                </label>
                            </div>
                            <div class="warranty d-none row">
                                <div class="col-md-4 false-padding-bottom-form form-group{{ $errors->has('warranty_year') ? ' has-error' : '' }}">
                                    <label>Year</label>

                                    <select name="warranty_year" class="form-control">
                                        <option value="">Select a year</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $data->warranty_year == $i ? 'selected' : '' }}>{{ $i }} year</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('warranty_year'))
                                        <span class="text-danger"><strong>{{ $errors->first('warranty_year') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-4 false-padding-bottom-form form-group{{ $errors->has('warranty_month') ? ' has-error' : '' }}">
                                    <label>Month</label>
                                    <select name="warranty_month" class="form-control">
                                        <option value="">Select a monthy</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ $data->warranty_month === $i ? 'selected' : '' }}>{{ $i }} month</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('warranty_month'))
                                        <span class="text-danger"><strong>{{ $errors->first('warranty_month') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-4 false-padding-bottom-form form-group{{ $errors->has('warranty_day') ? ' has-error' : '' }}">
                                    <label>Day</label>
                                    <select name="warranty_day" class="form-control">
                                        <option value="">Select a day</option>
                                        @for ($i = 1; $i <= 30; $i++)
                                            <option value="{{ $i }}" {{ $data->warranty_day == $i ? 'selected' : '' }}>{{ $i }} day</option>
                                        @endfor
                                    </select>

                                    @if ($errors->has('warranty_day'))
                                        <span class="text-danger"><strong>{{ $errors->first('warranty_day') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_type">Product Status</label><br>
                                <input type="radio" name="is_sold" value="1" id="typeSold1" {{ $data->is_sold == 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="typeSold1">
                                    Available
                                </label>
                                <input type="radio" name="is_sold" id="typeSold2" value="2" {{ $data->is_sold == 2 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="typeSold2">
                                    Sold
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_negotiable" id="is_negotiable" value=""  {{ $data->is_negotiable == 1 ? 'checked' : '' }}/>
                                <label for="is_negotiable">Is Negotiable</label><br>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone no</label>
                                <input type="number" class="form-control" id="phone" name="phone_no" value="{{ $data->phone_no }}" placeholder="Enter phone no">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $data->email }}" placeholder="Enter email" maxlength="300">
                            </div>
                            <div class="form-group">
                                <label for="selectDistrict">District</label>
                                <select id="selectDistrict" class="form-control selectpicker" data-live-search="true" onchange="getThanas(value)" required>
                                    <option selected disabled>Select a district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $data->thana->district_id == $district->id ? 'selected' : null }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selectThana">Thana</label>
                                <select class="form-control" id="selectThana" name="thana_id" data-live-search="true" disabled="">
                                </select>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                <label for="area">Area</label>
                                <input type="text" class="form-control" id="area" name="area" value="{{ $data->area }}" maxlength="300" disabled="">
                                @if ($errors->has('area'))
                                    <span class="text-danger"><strong>{{ $errors->first('area') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}" maxlength="300" disabled="" >
                                @if ($errors->has('address'))
                                    <span class="text-danger"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Previous Cover</label>
                                @foreach( $coverImages as $cover)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{ asset('storage/' . $cover->id . '/' . $cover->file_name) }}" id="disk-preview" class="img-thumbnail">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <label>Upload Cover</label>
                            <small>(Width: 1920px and Height: 600px)</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cover_image" id="coverFile">
                                <label class="custom-file-label" for="coverFile">Choose file</label>
                                @if ($errors->has('cover_image'))
                                    <span class="text-danger"><strong>{{ $errors->first('cover_image') }}</strong></span>
                                @endif
                            </div>
                            <table class="table table-bordered mt-2" id="dynamicProductImage">
                                <tr>
                                    <th>Add Product Image</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" name="product_image[]" id="productImage">
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
                                <label for="name">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Approved</option>
                                    <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Pending</option>
                                    <option value="3" {{ $data->status == 3 ? 'selected' : '' }}>Reject</option>
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
        let thanas = {!! json_encode( $thanas ?? null ) !!};
        let selectedThanaId = {!! json_encode( $data->thana_id ?? null ) !!};

        (function () {
            setSummary();
            setWarranty();
            getThanas();
        })()
        function getThanas() {
            let districtId = $('#selectDistrict option:selected').val();
            $('#selectThana').html('');
            $('#selectThana').attr('disabled', true);
            $('#area').attr('disabled', true);
            $('#address').attr('disabled', true);
            if(districtId != null){
                let selectedThanas = thanas.filter(thana => thana.district_id == districtId);
                $('#selectThana').append(`<option value="" selected disabled>Please Select a thana</option>`);
                $('#selectThana').attr('disabled', false);
                $('#area').attr('disabled', false);
                $('#address').attr('disabled', false);

                $.map(selectedThanas, function (value) {
                    let selectedvalue = value.id == selectedThanaId ? true : false;
                    $('#selectThana')
                        .append($("<option></option>")
                            .attr("value", value.id)
                            .prop('selected', selectedvalue)
                            .text(value.name));
                });
                $("#selectThana").selectpicker('refresh');
            }

        }
        function setSummary(){
            var type = $('input[name="product_type"]:checked').val();
            $('.summary').addClass('d-none');
            // $('#summary').prop('required', false);
            if (type == 2){
                $('.summary').removeClass('d-none');
                // $('#summary').prop('required', true);
            } else {
                $('#summary').val('');
            }
        }
        function setWarranty(){
            var type = $('input[name="warranty_availability"]:checked').val();
            $('.warranty').addClass('d-none');
            if (type == 1){
                $('.warranty').removeClass('d-none');
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
            $("#dynamicProductImage").append('<tr><td><div class="custom-file"><input type="file" class="custom-file-input" accept=".gif,.jpg,.jpeg,.png" id="productImage-'+i+'" name="product_image[]"><label class="custom-file-label" for="productImage-'+i+'">Choose file</label><label for="productImage'+i+'" class="limit-alert text-danger d-none">Image length for more than 2 mb</label><label for="productImage" class="type-alert text-danger d-none">Image type is not valid</label></div></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });
        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
@endsection

