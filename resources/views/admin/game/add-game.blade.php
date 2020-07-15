@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Games</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Games</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Game</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" role="form" class="w-75 mx-auto">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select class="form-control selectpicker" data-live-search="true">
                                    <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                    <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                    <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                                </select>

                                {{--                                <option class="form-control select1" id="name" name="name" placeholder="Enter Game Name" >--}}
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mode">Game Mode</label>
                                <input type="text" class="form-control" id="mode" name="gameMode" placeholder="Enter Game Mode">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script>
        $(".btn-submit").click(function(e){

            e.preventDefault();

            var name = $("input[name=name]").val();
            var description =  $.trim($("#description").val());
            var status = $("input[name=status]").val();
            console.log(name)
            console.log(description)
            console.log(status)

            $.ajax({
                type:'POST',
                url: "http://gamingapp.test/api/disk-conditions",
                headers: {
                    'Authorization' : 'Bearer ' + localStorage.getItem('token'),
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data:{name: name, description: description, status: status},

                success:function(data){
                    console.log(data)
                    swal({
                        title: "Good job!",
                        text: "Disk Condition Created Successfully!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                    window.location.replace('all-disk-conditions');
                }

            });
        });
    </script>
@endsection

