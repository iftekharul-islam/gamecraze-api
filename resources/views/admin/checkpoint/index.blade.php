@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Checkpoints</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Checkpoints</li>
                        </ol>
                    </div>
                </div>
            </div>
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
                    <!-- /.container-fluid -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('checkpoint.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Checkpoint</a>
                            </div>
                            <div class="card-body">
                                @if (count($checkpoints) > 0)
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($checkpoints as $key=>$checkpoint)
                                        <tr>
                                            <td><a href="#" onclick="dataDetails({{ $checkpoint->id }})">{{ $checkpoint->name }}</a></td>
                                            <td>
                                                @if ($checkpoint->status == 1)
                                                    <a class="badge-success badge text-white" >Active</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Inactive</a>
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary mr-3"
                                                   href="{{ route('checkpoint.edit', $checkpoint->id) }}"><i
                                                        class="far fa-edit"></i></a>
{{--                                                <button class="btn btn-danger btn-sm" type="button"--}}
{{--                                                        onclick="deletePlatform({{ $checkpoint->id }})">--}}
{{--                                                    <i class="far fa-trash-alt"></i></button>--}}
{{--                                                <form id="delete-form-{{ $platform->id }}"--}}
{{--                                                      action="{{ route('checkpoint.destroy', $checkpoint->id) }}"--}}
{{--                                                      method="post" class="d-none">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
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
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch dataDetails">
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
        $(document).ready(function () {
        });
        function dataDetails(id) {
            $.ajax({
                url: "checkpoint/" + id,
                method: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    let checkpointDetials = response.data;
                    var all = `<div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0 title">
                                        Checkpoint: ${checkpointDetials.name}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="lead"><b>Assign User :${checkpointDetials.user.name}</b></h2>
                                                <p class="text-muted text-sm"><b>Available: </b> ${checkpointDetials.availability_start_time} - ${checkpointDetials.availability_end_time}</p>
                                                <p class="text-muted text-sm"><b>Holiday: </b>${checkpointDetials.holiday} </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        ${checkpointDetials.flat_no}/${checkpointDetials.road_no} Block ${checkpointDetials.block_no},
                                                        <br> Area: ${checkpointDetials.area.name},
                                                        <br> Thana: ${checkpointDetials.area.thana.name},
                                                        <br> District: ${checkpointDetials.area.thana.district.name},
                                                        <br> Division: ${checkpointDetials.area.thana.district.division.name}.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                             </div>`
                    $('.dataDetails').html(all);

                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
        function deletePlatform(id) {
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
    </script>
@endsection

