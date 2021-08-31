@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thana</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('thana.all') }}">All Thana</a></li>
                            <li class="breadcrumb-item active">Thana</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="{{ route('thana.update', $thana->id) }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $thana->name }}">
                            </div>
                            <div class="form-group">
                                <label for="bn_name">Bangla Name</label>
                                <input type="text" class="form-control" name="bn_name" value="{{ $division->bn_name }}">
                            </div>
                            <div class="form-group">
                                <label for="division_id">District</label>
                                <select name="division_id" class="form-control selectpicker" data-live-search="true">
                                    @foreach($districts as $district)
                                        @if($thana->district_id == $district->id)
                                            <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                                            <?php continue 1; ?>
                                        @endif
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $thana->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $thana->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
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

