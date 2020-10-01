@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-4">
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header font-weight-bold">Upload Video</div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Filename</label>
                        <input type="text" name="filename" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload file</label>
                        <input type="file" accept="video/*" name="upload_file" class="form-control" required/>
                    </div>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </div>
            </form>
        </div>
    {{-- </div>
    <div class="row justify-content-center"> --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-weight-bold">My Videos</div>
                <div class="card-body">
                    <div class="row ">
                        @foreach($videos as $vid)
                        <div class="col-sm-6 d-flex justify-content-center">
                            {{-- <div class="embed-responsive"> --}}
                            <video class="embed-responsive-item" width="300" controls>
                                <source src="{{ asset('storage/'.$vid->path) }}">
                            </video>
                            {{-- </div> --}}
                        </div>
                        @if($loop->iteration % 2 == 0)
                    </div>
                    <div class="row">
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
