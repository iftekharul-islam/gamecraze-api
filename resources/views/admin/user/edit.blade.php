@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
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
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data" class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="rent_limit">Rent limit</label>
                                <select name="rent_limit" class="form-control">
                                    <option value="1" {{ $user->rent_limit == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $user->rent_limit == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $user->rent_limit == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $user->rent_limit == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $user->rent_limit == 5 ? 'selected' : '' }}>5</option>
                                </select>
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number">Phone Number</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger"><strong>{{ $errors->first('phone_number') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('identification_number') ? ' has-error' : '' }}">
                                <label for="identification_number">Identification Number</label>
                                <input type="text" class="form-control" id="identification_number" name="identification_number" value="{{ $user->identification_number }}">
                                @if ($errors->has('identification_number'))
                                    <span class="text-danger"><strong>{{ $errors->first('identification_number') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('identification_image') ? ' has-error' : '' }}">
                                <label for="identification_image">Identification image</label>
                                <input type="file" class="form-control" id="identification_image" name="identification_image" value="{{ $user->identification_image }}">
                                @if ($errors->has('identification_image'))
                                    <span class="text-danger"><strong>{{ $errors->first('identification_image') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                @if ($errors->has('password'))
                                    <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="false-padding-bottom-form form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                                @if ($errors->has('confirmPassword'))
                                    <span class="text-danger"><strong>{{ $errors->first('confirmPassword') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="status">User Type</label>
                                <select name="is_verified" class="form-control" required>
                                    <option value="0" {{ $user->is_verified == 0 ? 'selected' : '' }}>Rookie</option>
                                    <option value="1" {{ $user->is_verified == 1 ? 'selected' : '' }}>Elite</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
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

