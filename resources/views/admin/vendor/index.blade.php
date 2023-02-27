@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All vendors <span class="badge badge-primary">{{ $vendors->total() }}</span></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Games</li>
                        </ol>
                    </div>
                </div>
            </div>
        <!-- /.container-fluid -->
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
                    <div class="col-8">
                        <form action="{{ route('vendor') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9 form-group">
                                            <label>Vendor Search :</label>
                                            <input type="search" class="form-control" name="search" value="{{ Request::get('search') }}"
                                                   placeholder="Search Here by name/trade license no...">
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
                                <a href="{{ route('vendor.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Vendor</a>
                            </div>
                            <div class="card-body">
                                @if (count($vendors) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Serial no</th>
                                        <th>Shop Name</th>
                                        <th>Is verified</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $key=>$vendor)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $vendor->shop_name }}</td>
                                            <td>
                                                @if ($vendor->is_verified == 1)
                                                    <a class="badge-success badge text-white" >Verified</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Not Verified</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($vendor->status == 1)
                                                    <a class="badge-success badge text-white" >Active</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary mr-3"
                                                   href="{{ route('vendor.show', $vendor->id) }}"><i
                                                            class="far fa-eye"></i></a>
                                                <a class="btn btn-sm btn-primary mr-3"
                                                   href="{{ route('vendor.edit', $vendor->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm" type="button"
                                                        onclick="deleteGame({{ $vendor->id }})">
                                                    <i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $vendor->id }}"
                                                      action="{{ route('game.destroy', $vendor->id) }}"
                                                      method="post" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3"> {{ $vendors->appends(Request::all())->links() }} </div>
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
        function deleteGame(id) {
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
                        title: 'Processing!',
                        text: 'Your file delete is on processing...',
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
    </script>
@endsection

