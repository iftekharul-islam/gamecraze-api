@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Notice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Notice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
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

        <!-- Main content -->
        <section class="content col-md-10">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Notice</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('notice.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title ...">
                                @if ($errors->has('title'))
                                    <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description ..."></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">Status</label>
                                <select name="status" class="form-control selectpicker">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger"><strong>{{ $errors->first('status') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-submit float-right">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <h3 class="card-title">Notice list</h3>
                                </div>
                                @if (count($data) > 0)
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Create date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inctive</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')  }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary mr-3"
                                                       href="{{ route('notice.edit', $item->id) }}"><i
                                                            class="far fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm" type="button"
                                                            onclick="deleteGame({{ $item->id }})">
                                                        <i class="far fa-trash-alt"></i></button>
                                                    <form id="delete-form-{{ $item->id }}"
                                                          action="{{ route('notice.delete', $item->id) }}"
                                                          method="post" style="display: none;">
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
