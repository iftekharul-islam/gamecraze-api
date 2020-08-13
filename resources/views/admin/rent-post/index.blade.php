@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Rent post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Rent post</li>
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
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Renter name</th>
                                        <th>Game Name</th>
                                        <th>Available from</th>
                                        <th>Max Week</th>
                                        <th>Approval</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rents as $key=>$rent)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $rent->user->name }}</td>
                                            <td>
                                                <a href="{{ route('rentPost.show', $rent->id) }}">{{ $rent->game->name ?? '' }}</a>
                                            </td>
                                            <td>{{ $rent->availability }}</td>
                                            <td>{{ $rent->max_week }}</td>
                                            <td>
                                                @if ($rent->status === 1)
                                                    <a class="badge-success badge text-white" >Approved</a>
                                                @elseif ($rent->status === 0)
                                                    <a class="badge-danger badge text-white" >Rejected</a>
                                                @else
                                                    <a class="badge-warning badge text-white" >Pending</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rent->status == 0 || $rent->status === null)
                                                    <button class="btn btn-success btn-sm" type="button"
                                                            onclick="makeApprove({{ $rent->id }})"> <i class="fa fa-check" aria-hidden="true"></i></button>
                                                    <form id="approve-form-{{ $rent->id }}"
                                                          action="{{ route('rentPost.approve', $rent->id) }}"
                                                          method="post" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endif
                                                @if ($rent->status == 1 || $rent->status === null)
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                            onclick="makeReject({{ $rent->id }})"><i class="fa fa-times mr-1" aria-hidden="true"></i></button>
                                                    <form id="reject-form-{{ $rent->id }}"
                                                          action="{{ route('rentPost.reject', $rent->id) }}"
                                                          method="post" class="d-none">
                                                        <input type="text" class="d-none" id="reason" name="reason" value="">
                                                        @csrf
                                                    </form>
                                                @endif
{{--                                                <a class="btn btn-sm btn-primary mr-3"--}}
{{--                                                   href="{{ route('game.edit', $game->id) }}"><i--}}
{{--                                                        class="far fa-edit"></i></a>--}}
                                                <a href="{{ route('rentPost.show', $rent->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>
{{--                                                <button class="btn btn-danger btn-sm" type="button"--}}
{{--                                                        onclick="deletePost({{ $rent->id }})">--}}
{{--                                                    <i class="far fa-trash-alt"></i></button>--}}
{{--                                                <form id="delete-form-{{ $rent->id }}"--}}
{{--                                                      action="{{ route('rentPost.destroy', $rent->id) }}"--}}
{{--                                                      method="post" class="d-none">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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

