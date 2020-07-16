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
                    <form method="post" action="{{ route('game.store') }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <input type="text" class="form-control d-none" id="rating" name="rating">
                        <input type="text" class="form-control d-none" id="released" name="released">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select name="name" class="form-control selectpicker gamePick" data-live-search="true" data-placeholder="Select.." id="gameList">
                                    <option data-tokens="" selected disabled>Select a game...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="mode">Game Mode</label>
                                <input type="text" class="form-control" id="mode" name="game_mode" placeholder="Enter Game Mode">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>Game image</label>--}}
{{--                                <input type="file" class="form-control" id="game_image" name="game_image">--}}
{{--                            </div>--}}
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
        $(document).ready(function() {
            $.ajax({
                method:'GET',
                url:'https://api.rawg.io/api/games?page=1&page_size=100',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success:function(data) {
                    let gameList = data.results;
                    let optionValue = '';
                    $.each(gameList, function( index, value ) {
                        // console.log( index + ": " + value.name );
                        optionValue += `<option data-tokens="${value.id}"
                                                data-rating="${value.rating}"
                                                data-released="${value.released}">
                                                ${value.name}
                                        </option>`
                    });
                    $('#gameList').append(`${optionValue}`);
                    $('#gameList').selectpicker('refresh');
                    console.log(optionValue);
                    // forEach(gameList as game)
                    // {
                    //     console.log(game);
                    // }
                    console.log(gameList);
                    $('#gameList').change(function () {
                        let game_rating = $('#gameList').children("option:selected").data('rating');
                        $('#rating').val(game_rating);
                        let game_released = $('#gameList').children("option:selected").data('released');
                        $('#released').val(game_released);
                    });

                }
            });
        });
        {{--$(".btn-submit").click(function(e){--}}

        {{--    e.preventDefault();--}}

        {{--    var name = $("input[name=name]").val();--}}
        {{--    var description =  $.trim($("#description").val());--}}
        {{--    var status = $("input[name=status]").val();--}}
        {{--    console.log(name)--}}
        {{--    console.log(description)--}}
        {{--    console.log(status)--}}

        {{--    $.ajax({--}}
        {{--        type:'POST',--}}
        {{--        url: "http://gamingapp.test/api/disk-conditions",--}}
        {{--        headers: {--}}
        {{--            'Authorization' : 'Bearer ' + localStorage.getItem('token'),--}}
        {{--            'X-CSRF-Token': '{{ csrf_token() }}',--}}
        {{--        },--}}
        {{--        data:{name: name, description: description, status: status},--}}

        {{--        success:function(data){--}}
        {{--            console.log(data)--}}
        {{--            swal({--}}
        {{--                title: "Good job!",--}}
        {{--                text: "Disk Condition Created Successfully!",--}}
        {{--                icon: "success",--}}
        {{--                button: "Aww yiss!",--}}
        {{--            });--}}
        {{--            window.location.replace('all-disk-conditions');--}}
        {{--        }--}}

        {{--    });--}}
        {{--});--}}
    </script>
@endsection

