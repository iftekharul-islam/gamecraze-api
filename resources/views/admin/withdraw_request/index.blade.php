@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Withdraw Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Withdraw Request</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>User name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Requested</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td><a href="{{ route('user.show', $item->user->id) }}">{{ $item->user->name }} {{ $item->user->last_name }}</a></td>
                                                <td>{{ $item->amount }}</td>
                                                <td>
                                                    @if ($item->status === 1)
                                                        <a class="badge-success badge text-white" >Approved</a>
                                                    @elseif ($item->status === 2)
                                                        <a class="badge-danger badge text-white" >Rejected</a>
                                                    @else
                                                        <a class="badge-info badge text-white" >Pending</a>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                                <td>
                                                    @if ($item->status === null)
                                                        <button class="btn btn-success btn-sm" type="button"
                                                                onclick="makeApprove({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                        <form id="approve-form-{{ $item->id }}"
                                                              action="{{ route('withdraw.request.approve', $item->id) }}"
                                                              method="get" class="d-none">
                                                            @csrf
                                                        </form>

                                                        <button class="btn btn-danger btn-sm" type="button"
                                                                onclick="makeReject({{ $item->id }})"><i class="fa fa-times mr-1" aria-hidden="true"></i></button>
                                                        <form id="reject-form-{{ $item->id }}"
                                                              action="{{ route('withdraw.request.reject', $item->id) }}"
                                                              method="get" class="d-none">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $data->appends(Request::all())->links() }}
                                    </div>
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
        // function makeReject (id) {
        //     const swalWithBootstrapButtons = Swal.mixin({
        //         customClass: {
        //             confirmButton: 'btn btn-success',
        //             cancelButton: 'btn btn-danger ml-2'
        //         },
        //         buttonsStyling: false
        //     });
        //     // const { value: formValues } =Swal.fire({
        //     //     showCancelButton: true,
        //     //     title: 'Reject Reason',
        //     //     html:
        //     //         '<input id="swal-input1" class="swal2-input" placeholder="Explain Reject reason..">' +
        //     //         '<textarea class="swal2-input" id="swal-input2" cols="30" placeholder="Type your Comment here..." rows="30"></textarea>',
        //     //     focusConfirm: false,
        //     //     preConfirm: () => {
        //     //         return [
        //     //             document.getElementById('swal-input1').value,
        //     //             document.getElementById('swal-input2').value
        //     //         ]
        //     //     }
        //     swalWithBootstrapButtons.fire ({
        //         showCancelButton: true,
        //         inputValidator: (value) => {
        //             if (!value) {
        //                 return 'You need to write something!'
        //             }
        //         },
        //     }).then ((result) => {
        //         if (result.value) {
        //             $('#reason').val(result.value);
        //             document.getElementById('reject-form-' + id).submit();
        //             swalWithBootstrapButtons.fire({
        //                 title: 'Rejected!',
        //                 text: 'Post rejected successfully.',
        //                 icon: 'success',
        //                 timer: 1500,
        //             })
        //         } else if (
        //             result.dismiss === Swal.DismissReason.cancel
        //         ) {
        //             swalWithBootstrapButtons.fire({
        //                 title: 'Cancelled',
        //                 text: 'No action has been taken!',
        //                 icon: 'info',
        //                 timer: 1500,
        //             })
        //         }
        //     });
        // }
    </script>
@endsection

