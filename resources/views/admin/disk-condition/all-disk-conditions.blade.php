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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Disk Conditions</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
        $(document).ready(function () {
            $.ajax({
                url: "http://gamingapp.test/api/disk-conditions",
                type:'GET',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(result){
                    console.log(result)
                    var res='';
                    $.each (result.data, function (key, value) {
                        res +=
                            `<tr id="disk-${value.id}">
                                <td>${value.id}</td>
                                <td>${value.name_of_type}</td>
                                <td>${value.description}</td>
                                <td>${value.status}</td>
                                <td><button class="btn btn-primary">Edit</button></td>
                                <td><button class="btn btn-danger" onclick="deleteDiskCondition(${value.id})">Delete</button></td>
                            </tr>`;
                    });
                    $('tbody').html(res);
                }});
        });

        function deleteDiskCondition(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "http://gamingapp.test/api/disk-conditions/" + id,
                            type:'DELETE',
                            headers: {
                                'Authorization' : 'Bearer ' + localStorage.getItem('token'),
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success: function(result){
                                $('#disk-' + id).remove();
                                console.log(result);
                            }});
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }
    </script>
@endsection
