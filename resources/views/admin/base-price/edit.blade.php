@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Base Price</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit Base Price</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('basePrice.update', $price->id) }}" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                                <label for="start">Start price</label>
                                <input type="number" class="form-control" id="start" name="start" value="{{ $price->start }}">
                                @if ($errors->has('start'))
                                    <span class="text-danger"><strong>{{ $errors->first('start') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                <label for="end">Start price</label>
                                <input type="number" class="form-control" id="end" name="end" value="{{ $price->end }}">
                                @if ($errors->has('end'))
                                    <span class="text-danger"><strong>{{ $errors->first('end') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('base') ? ' has-error' : '' }}">
                                <label for="base">Start price</label>
                                <input type="number" class="form-control" id="base" name="base" value="{{ $price->base }}">
                                @if ($errors->has('base'))
                                    <span class="text-danger"><strong>{{ $errors->first('base') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('second_week') ? ' has-error' : '' }}">
                                <label for="second_week">Second week</label>
                                <input type="number" step="any" min="0" class="form-control" id="second_week" name="second_week" value="{{ $price->second_week }}">
                                @if ($errors->has('second_week'))
                                    <span class="text-danger"><strong>{{ $errors->first('second_week') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group {{ $errors->has('third_week') ? ' has-error' : '' }}">
                                <label for="third_week">Third week</label>
                                <input type="number" step="any" min="0" class="form-control" id="third_week" name="third_week" value="{{ $price->third_week }}">
                                @if ($errors->has('third_week'))
                                    <span class="text-danger"><strong>{{ $errors->first('third_week') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $price->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $price->status == 0 ? 'selected' : '' }}>Inactive</option>
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

