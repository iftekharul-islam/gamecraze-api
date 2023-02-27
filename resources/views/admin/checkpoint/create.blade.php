@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Checkpoint</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Checkpoint</li>
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
                        <h3 class="card-title">Add Checkpoint</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('checkpoint.store') }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Platform Name" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                <label for="user_id">Assign User</label>
                                @if (count($users) > 0)
                                    <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true" required>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name ? $user->name : $user->phone_number}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger" value="Please fill the user table first !!!" disabled>
                                @endif
                                @if ($errors->has('user_id'))
                                    <span class="text-danger"><strong>{{ $errors->first('user_id') }}</strong></span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-3 false-padding-bottom-form form-group{{ $errors->has('flat_no') ? ' has-error' : '' }}">
                                    <label for="flat_no">Flat No</label>
                                    <input type="text" class="form-control" id="flat_no" name="flat_no" placeholder="Enter Flat No" required>
                                    @if ($errors->has('flat_no'))
                                        <span class="text-danger"><strong>{{ $errors->first('flat_no') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-3 false-padding-bottom-form form-group{{ $errors->has('house_no') ? ' has-error' : '' }}">
                                    <label for="house_no">House No</label>
                                    <input type="text" class="form-control" id="house_no" name="house_no" placeholder="Enter House No" required>
                                    @if ($errors->has('house_no'))
                                        <span class="text-danger"><strong>{{ $errors->first('house_no') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-3 false-padding-bottom-form form-group{{ $errors->has('road_no') ? ' has-error' : '' }}">
                                    <label for="road_no">Road No</label>
                                    <input type="text" class="form-control" id="road_no" name="road_no" placeholder="Enter Road No" required>
                                    @if ($errors->has('road_no'))
                                        <span class="text-danger"><strong>{{ $errors->first('road_no') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-3 false-padding-bottom-form form-group{{ $errors->has('block_no') ? ' has-error' : '' }}">
                                    <label for="block_no">Block No</label>
                                    <input type="text" class="form-control" id="block_no" name="block_no" placeholder="Enter Block No" required>
                                    @if ($errors->has('block_no'))
                                        <span class="text-danger"><strong>{{ $errors->first('block_no') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('area_id') ? ' has-error' : '' }}">
                                <label for="area_id">Area</label>
                                @if (count($areas) > 0)
                                    <select name="area_id" id="area_id" class="form-control selectpicker" data-live-search="true" required>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control text-danger" value="Please fill the area table first !!!" disabled>
                                @endif
                                @if ($errors->has('area_id'))
                                    <span class="text-danger"><strong>{{ $errors->first('area_id') }}</strong></span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 false-padding-bottom-form form-group{{ $errors->has('availability_start_time') ? ' has-error' : '' }}">
                                    <label for="availability_start_time">Available start time</label>
                                    <input type="time" class="form-control" id="availability_start_time" name="availability_start_time">
                                    @if ($errors->has('availability_start_time'))
                                        <span class="text-danger"><strong>{{ $errors->first('availability_start_time') }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-md-6 false-padding-bottom-form form-group{{ $errors->has('availability_end_time') ? ' has-error' : '' }}">
                                    <label for="availability_end_time">Available end time</label>
                                    <input type="time" class="form-control" id="availability_end_time" name="availability_end_time">
                                    @if ($errors->has('availability_end_time'))
                                        <span class="text-danger"><strong>{{ $errors->first('availability_end_time') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('holiday') ? ' has-error' : '' }}">
                                <label for="holiday">Holiday</label>
                                <input type="text" class="form-control" id="holiday" name="holiday" placeholder="Enter your holiday" >
                                @if ($errors->has('holiday'))
                                    <span class="text-danger"><strong>{{ $errors->first('holiday') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                <label for="comment">Comments</label>
                                <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter your comment here...">
                                @if ($errors->has('comment'))
                                    <span class="text-danger"><strong>{{ $errors->first('comment') }}</strong></span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

