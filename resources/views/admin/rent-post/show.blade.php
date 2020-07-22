@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
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
        @endif<!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}"
                                         alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{ $rent->user->name }}</h3>

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Gender</b> <a class="float-right">{{ $rent->user->gender }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> <a class="float-right">{{ $rent->user->email }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Birthday</b> <a class="float-right">{{ $rent->user->birth_date }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone Number</b> <a class="float-right">{{ $rent->user->phone_number }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Game Post details</h3>
                                <div class="float-right">
                                    @if ($rent->status == 1)
                                        <button class="btn btn-sm btn-success disabled"><i class="fa fa-check" aria-hidden="true"></i>Approved</button>
                                    @else
                                        <button class="btn btn-success btn-sm" type="button"
                                                onclick="makeApprove({{ $rent->id }})">Approve</button>
                                        <form id="approve-form-{{ $rent->id }}"
                                              action="{{ route('rentPost.approve', $rent->id) }}"
                                              method="post" class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                                    @if ($rent->status === 0)
                                            <button class="btn btn-sm btn-danger disabled"><i class="fa fa-times mr-1" aria-hidden="true"></i>Rejected</button>
                                    @else
                                        <button class="btn btn-danger btn-sm" type="button"
                                                onclick="makeReject({{ $rent->id }})">Reject</button>
                                        <form id="reject-form-{{ $rent->id }}"
                                              action="{{ route('rentPost.reject', $rent->id) }}"
                                              method="post" class="d-none">
                                            <input type="text" class="d-none" id="reason" name="reason" value="">
                                            @csrf
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>name:</td>
                                            <td>{{ $rent->game->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Description:</td>
                                            <td>{{ $rent->game->description }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mode:</td>
                                            <td>{{ $rent->game->game_mode }}</td>
                                        </tr>
                                        <tr>
                                            <td>Platform:</td>
                                            <td>{{ $rent->platform->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rating:</td>
                                            <td>{{ $rent->game->rating }}</td>
                                        </tr>
                                        <tr>
                                            <td>Disk condition:</td>
                                            <td>{{ $rent->diskCondition->name ?? '' }} ({{ $rent->diskCondition->description ?? '' }})</td>
                                        </tr>
                                        <tr>
                                            <td>Max Rent Week:</td>
                                            <td>{{ $rent->max_week }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="fancy4">
                                <div class="row">
                                    <div class="col">
                                        <span>Disk image:</span>
                                        <div class="disk-preview disk">
                                            <img src="{{ asset('storage/rent-image/'. $rent->cover_image) }}" id="disk-preview" class="img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <span>Cover image</span>
                                        <div class="cover-preview disk">
                                            <img src="{{ asset('storage/rent-image/'. $rent->disk_image) }}" class="img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
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
                text: "Want to Approve this post",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
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
            // const { value: formValues } =Swal.fire({
            //     showCancelButton: true,
            //     title: 'Reject Reason',
            //     html:
            //         '<input id="swal-input1" class="swal2-input" placeholder="Explain Reject reason..">' +
            //         '<textarea class="swal2-input" id="swal-input2" cols="30" placeholder="Type your Comment here..." rows="30"></textarea>',
            //     focusConfirm: false,
            //     preConfirm: () => {
            //         return [
            //             document.getElementById('swal-input1').value,
            //             document.getElementById('swal-input2').value
            //         ]
            //     }
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

