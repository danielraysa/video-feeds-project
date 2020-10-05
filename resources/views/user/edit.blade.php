@extends('layouts.app', ['title' => 'Edit Video'])

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-4 col-sm-12">
            <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header font-weight-bold">Edit Video</div>

                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" name="filename" class="form-control" value="{{ $video->filename }}" required/>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Description</label>
                        <textarea name="description" class="form-control" rows="4"required>{{ $video->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Upload file</label>
                        <input type="file" accept="video/*" name="upload_file" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
            </form>
        </div>
    {{-- </div>
    <div class="row justify-content-center"> --}}
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <video class="embed-responsive-item" style="width: 100%" autoplay muted loop>
                                <source src="{{ asset('storage/'.$video->path) }}">
                            </video>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
