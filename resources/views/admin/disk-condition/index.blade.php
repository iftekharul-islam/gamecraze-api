@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Disk Conditions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Disk Condition</li>
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
                        <div class="card">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($diskConditions as $key=>$diskCondition)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $diskCondition->name }}</td>
                                            <td>{{ $diskCondition->description }}</td>
                                            <td>
                                                @if ($diskCondition->status == 1)
                                                    <a class="badge-success badge text-white" >Active</a>
                                                @else
                                                    <a class="badge-danger badge text-white" >Inactive</a>
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-primary mr-3"
                                                   href="{{ route('diskCondition.edit', $diskCondition->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                                <button class="btn btn-danger btn-sm" type="button"
                                                        onclick="removeDepartment({{ $diskCondition->id }})">
                                                    <i class="far fa-trash-alt"></i></button>
                                                <form id="delete-form-{{ $diskCondition->id }}"
                                                      action="{{ route('diskCondition.destroy', $diskCondition->id) }}"
                                                      method="post" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
        function removeDepartment(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('delete-form-' + id).submit();
                        swal ({
                            title: "Disk Condition Deleted!",
                            text: "Disk Condition Delete Successful!",
                            timer: 1500
                        });
                    }
                    else {
                        swal("Your information is safe!");
                    }
                });
        }
    </script>
@endsection