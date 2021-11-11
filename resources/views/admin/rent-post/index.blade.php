@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lend posts <span class="badge badge-primary">{{ $rents->total() }}</span></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Lend posts</li>
                        </ol>
                    </div>
                </div>
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
            </div>
        <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('rentPost.all') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <label for="disk_type">Disk type :</label>
                                            <select name="disk_type" id="type" class="form-control">
                                                <option selected disabled>Select Disk Type</option>
                                                <option value="0" {{ Request::get('disk_type') != 1 && Request::get('disk_type') != null ? 'selected' : ''}}>Digital</option>
                                                <option value="1" {{ Request::get('disk_type') == 1 ? 'selected' : ''}}>Physical</option>
                                            </select>
                                        </div>
                                        <div class="col-6 form-group">
                                            <label for="status">Approval status:</label>
                                            <select name="status" id="status" class="form-control">
                                                <option selected disabled>Select Approval status</option>
                                                <option value="0" {{ Request::get('status') != 1 && Request::get('status') != null ? 'selected' : ''}}>Pending</option>
                                                <option value="1" {{ Request::get('status') == 1 ? 'selected' : ''}}>Approved</option>
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
                                <a href="{{ route('rent.export', ['type_id' => $disk_type, 'status' => $status] ) }}" class="btn btn-primary">Export Lend Posts</a>
                            </div>
                            <div class="card-body">
                                @if (count($rents) > 0)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Lender name</th>
                                        <th>Game Name</th>
                                        <th>Available from</th>
                                        <th>Max Week</th>
                                        <th>Disk Type</th>
                                        <th>Approval</th>
                                        <th>Post Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rents as $key => $rent)
                                        <tr>
                                            <td>{{ $rents->firstItem() + $key }}</td>
                                            <td><a href="{{ route('user.show', $rent->user->id) }}">{{ $rent->user->name }} {{ $rent->user->last_name }}</a></td>
                                            <td>
                                                <a href="{{ route('rentPost.show', $rent->id) }}">{{ $rent->game->name ?? '' }}</a>
                                            </td>
                                            <td width="150px">{{ date('d F Y', strtotime($rent->availability)) }}</td>
                                            <td>{{ $rent->max_week }}</td>
                                            <td>
                                                @if ($rent->disk_type == 1)
                                                    <a class="badge-success badge text-white" >Physical Copy</a>
                                                @elseif ($rent->disk_type == 0)
                                                    <a class="badge-warning badge text-white" >Digital Copy</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rent->status === 1)
                                                    <a class="badge-success badge text-white" >Approved</a>
                                                @elseif ($rent->status === 0)
                                                    <a class="badge-warning badge text-white" >Pending</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Rejected</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rent->status_by_user == true)
                                                    <a class="badge-success badge text-white" >Active</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Inactive</a>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        @if ($rent->status == 0 || $rent->status === 2)
                                                            <a class="dropdown-item" href="#" onclick="makeApprove({{ $rent->id }})">Approve</a>
                                                        @endif
                                                        @if ($rent->status == 1 || $rent->status === 0)
                                                            <a class="dropdown-item" href="#" onclick="makeReject({{ $rent->id }})">Reject</a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('rentPost.show', $rent->id) }}">Show</a>
                                                        <a class="dropdown-item" href="{{ route('rentPost.edit', $rent->id) }}">Edit</a>
                                                    </div>
                                                    <form id="approve-form-{{ $rent->id }}"
                                                          action="{{ route('rentPost.approve', $rent->id) }}"
                                                          method="get" class="d-none">
                                                        @csrf
                                                    </form>
                                                    <form id="reject-form-{{ $rent->id }}"
                                                          action="{{ route('rentPost.reject', $rent->id) }}"
                                                          method="post" class="d-none">
                                                        @csrf
                                                        <input type="text" class="d-none" id="reason" name="reason" value="">
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3"> {{ $rents->appends(Request::all())->links() }} </div>
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
        // function deletePost (id) {
        //     const swalWithBootstrapButtons = Swal.mixin ({
        //         customClass: {
        //             confirmButton: 'btn btn-success ml-2',
        //             cancelButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     })
        //
        //     swalWithBootstrapButtons.fire ({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Yes, delete it!',
        //         cancelButtonText: 'No, cancel!',
        //         reverseButtons: true
        //     }).then ((result) => {
        //         if (result.value) {
        //             document.getElementById('delete-form-' + id).submit();
        //             swalWithBootstrapButtons.fire({
        //                 title: 'Deleted!',
        //                 text: 'Your file has been deleted.',
        //                 icon: 'success',
        //                 timer: 1500,
        //             })
        //         } else if (
        //             /* Read more about handling dismissals below */
        //             result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //             swalWithBootstrapButtons.fire({
        //                 title: 'Cancelled',
        //                 text: 'Your imaginary file is safe :)',
        //                 icon: 'error',
        //                 timer: 1500,
        //             })
        //         }
        //     });
        // }
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
                text: "Want to Approve this post",
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
                        text: 'Your file has been approved.',
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
                        return 'You need to write something!'
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

