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
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @if ($item->status == 2)
                                                        <button class="btn btn-success btn-sm" type="button"
                                                                onclick="makeApprove({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                        <form id="approve-form-{{ $item->id }}"
                                                              action="{{ route('product.approve', $item->id) }}"
                                                              method="get" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @elseif ($item->status == 1)
                                                        <button class="btn btn-danger btn-sm" type="button"
                                                                onclick="makeReject({{ $item->id }})"><i class="fa fa-times mr-1" aria-hidden="true"></i></button>
                                                        <form id="reject-form-{{ $item->id }}"
                                                              action="{{ route('product.reject', $item->id) }}"
                                                              method="get" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @endif
                                                    <a class="btn btn-sm btn-primary"
                                                       href="{{ route('product.edit', $item->id) }}"><i
                                                            class="far fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                            onclick="deleteCategory({{ $item->id }})">
                                                        <i class="far fa-trash-alt"></i></button>
                                                    <form id="delete-form-{{ $item->id }}"
                                                          action="{{ route('product.destroy', $item->id) }}"
                                                          method="post" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="btn btn-sm btn-primary mr-3" href="{{ route('product.show', $item->id) }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </div>
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
                    confirmButton: 'btn btn-success ml-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire ({
                title: "Are you sure?",
                text: "Want to reject this request",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then ((result) => {
                if (result.value) {
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
