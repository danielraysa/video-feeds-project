@extends('layouts.app', ['title' => $video->filename])

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12">
                            <video class="embed-responsive-item" style="width: 100%"  controls>
                                <source src="{{ $video->video_url() }}">
                            </video>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="mx-lg-0 mx-3 mt-3">
                                <h4 class=""><b>{{ $video->filename }}</b></h4>
                                <p class="mb-3" style="font-size: 0.85rem"><a href="{{ route('users.show', $video->video_owner->id) }}">&#64;{{ $video->video_owner->name }}</a> — {{ $video->description }}</p>
                                <div class="mb-2">
                                    <i style="font-size: 1.25rem" class="like-video fas fa-heart text-danger stroke-transparent" data-id="{{ $video->id }}" data-like="true"></i> 40 &nbsp;
                                    <i style="font-size: 1.25rem" class="comment-video fas fa-comment text-white stroke-transparent"></i> 23
                                </div>
                                <div class="row">
                                    <div class="col-4">Username</div>
                                    <div class="col-8">komentar.....</div>
                                </div>
                                <div class="form-group mt-2">
                                    <textarea name="comment" class="form-control"></textarea>
                                    <button type="button" class="btn btn-primary">Komentar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
