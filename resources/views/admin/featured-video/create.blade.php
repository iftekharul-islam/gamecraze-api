@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Videos</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('video.all') }}">Videos</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    @if ($errors->has('success'))
                        <span class="help-block"><strong>{{ $errors->first('success') }}</strong></span>
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">Add Video</h3>
                    </div>
                    <form method="post" action="{{ route('video.store') }}" enctype="multipart/form-data"
                          class="w-75 mx-auto">
                        @csrf
                        <div class="card-body">
                            <div class="false-padding-bottom-form form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="name">Title</label>
                                <input name="title" class="form-control" placeholder="Enter a title..." required>
                                @if ($errors->has('title'))
                                    <span class="text-danger"><strong>{{ $errors->first('title') }}</strong></span>
                                @endif
                            </div>

                            <div class="false-padding-bottom-form form-group{{ $errors->has('video_url') ? ' has-error' : '' }}">
                                <label for="name">Video URL</label>
                                <input name="video_url" class="form-control" placeholder="Enter URL" required>
                                @if ($errors->has('video_url'))
                                    <span class="text-danger"><strong>{{ $errors->first('video_url') }}</strong></span>
                                @endif
                            </div>

                            <div class="false-padding-bottom-form form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name">Is Featured</label>
                                <select name="is_featured" class="form-control select2">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger"><strong>{{ $errors->first('status') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </section>
    </div>
@endsection

