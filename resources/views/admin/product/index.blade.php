@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('product') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 form-group">
                                            <label for="status">Status:</label>
                                            <select name="status" class="form-control">
                                                <option value="" selected >All status</option>
                                                <option value="1" {{ Request::get('status') == 1 ? 'selected' : '' }}>Approved</option>
                                                <option value="2" {{ Request::get('status') == 2 ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="status">Product type:</label>
                                            <select name="product_type" class="form-control">
                                                <option value="" selected>All Product type</option>
                                                <option value="1" {{ Request::get('product_type') == 1 ? 'selected' : '' }}>New</option>
                                                <option value="2" {{ Request::get('product_type') == 2 ? 'selected' : '' }}>Used</option>
                                            </select>
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="status">Product status:</label>
                                            <select name="is_sold" class="form-control">
                                                <option value="" selected>All Product status</option>
                                                <option value="1" {{ Request::get('is_sold') == 1 ? 'selected' : '' }}>Available</option>
                                                <option value="2" {{ Request::get('is_sold') == 2 ? 'selected' : '' }}>Sold</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group float-right">
                                            <button type="submit" class="btn btn-primary float-right">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12">
                        <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('product.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Product</a>
                                </div>
                            <div class="card-body">
                                @if (count($data) > 0)
                                <table id="example2" class="table table-bordered table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Sub Category</th>
                                        <th>Amount</th>
                                        <th>Product type</th>
                                        <th>Product Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key=>$item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td><a href="{{ route('user.show', $item->user->id) }}">{{ $item->user->name }} {{ $item->user->last_name }}</a></td>
                                            <td>{{ $item->subcategory->name ?? 'N/A' }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                @if ($item->product_type == 1)
                                                    <a class="badge-success badge text-white" >New</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Used</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->is_sold == 1)
                                                    <a class="badge-success badge text-white" >Available</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Sold</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <a class="badge-success badge text-white" >Approved</a>
                                                @elseif ($item->status == 2)
                                                    <a class="badge-danger badge text-white" >Pending</a>
                                                @elseif ($item->status == 3)
                                                    <a class="badge-danger badge text-white" >Rejected</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @if ($item->status == 0 || $item->status === 2)
                                                            <a class="dropdown-item" href="#" onclick="makeApprove({{ $item->id }})">Approve</a>
                                                        @endif
                                                        @if ($item->status == 1 || $item->status === 0)
                                                            <a class="dropdown-item" href="#" onclick="makeReject({{ $item->id }})">Reject</a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('product.show', $item->id) }}">Show</a>
                                                        <a class="dropdown-item" href="{{ route('product.edit', $item->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="#" onclick="deleteCategory({{ $item->id }})">Delete</a>
                                                    </div>
                                                    <form id="approve-form-{{ $item->id }}"
                                                          action="{{ route('product.approve', $item->id) }}"
                                                          method="get" class="d-none">
                                                        @csrf
                                                    </form>
                                                    <form id="reject-form-{{ $item->id }}"
                                                          action="{{ route('product.reject', $item->id) }}"
                                                          method="post" class="d-none">
                                                        @csrf
                                                        <input type="text" class="d-none" id="reason" name="reason" value="">
                                                    </form>
                                                    <form id="delete-form-{{ $item->id }}"
                                                          action="{{ route('product.destroy', $item->id) }}"
                                                          method="post" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <h4 class="text-center">No data found</h4>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script type="text/javascript">
        function deleteCategory (id) {
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
                    document.getElementById('delete-form-' + id).submit();
                    swalWithBootstrapButtons.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon: 'success',
                        timer: 1500,
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        icon: 'error',
                        timer: 1500,
                    })
                }
            });
        }

        function makeApprove (id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire ({
                title: "Are you sure?",
                text: "Want to Approve this request",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then ((result) => {
                if (result.value) {
                    document.getElementById('approve-form-' + id).submit();
                    swalWithBootstrapButtons.fire({
                        title: 'Approved!',
                        text: 'Your request has been approved.',
                        icon: 'success',
                        timer: 1500,
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Cancelled',
                        text: 'No action has been taken!',
                        icon: 'info',
                        timer: 1500,
                    })
                }
            });
        }
        function makeReject (id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire ({
                title: 'Reject Reason',
                input: 'text',
                inputPlaceholder: 'Explain Reject reason..',
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write the reason!'
                    }
                },
            }).then ((result) => {
                if (result.value) {
                    $('#reason').val(result.value);
                    document.getElementById('reject-form-' + id).submit();
                    swalWithBootstrapButtons.fire({
                        title: 'Rejected!',
                        text: 'Post rejected successfully.',
                        icon: 'success',
                        timer: 1500,
                    })
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: 'Cancelled',
                        text: 'No action has been taken!',
                        icon: 'info',
                        timer: 1500,
                    })
                }
            });
        }
    </script>
@endsection
