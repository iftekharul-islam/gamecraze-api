@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Notice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Notice</li>
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
                        <h3 class="card-title">Edit Notice</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('notice.update', $data->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
                                @if ($errors->has('title'))
                                    <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" name="description">{{ $data->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger"><strong>{{ $errors->first('description') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">Status</label>
                                <select name="status" class="form-control selectpicker">
                                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
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
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
@endsection
