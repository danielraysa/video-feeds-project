@extends('layouts.app', ['title' => $video->filename])
@push('js')
<script>
    var tribute = new Tribute({
        values: [
            {
            key: "Jordan Humphreys",
            value: "Jordan Humphreys",
            email: "getstarted@zurb.com"
            },
            {
            key: "Sir Walter Riley",
            value: "Sir Walter Riley",
            email: "getstarted+riley@zurb.com"
            }
        ],
        selectTemplate: function(item) {
            return (
            '<span contenteditable="false"><a href="http://zurb.com" target="_blank" title="' +
            item.original.email +
            '">' +
            item.original.value +
            "</a></span>"
            );
        }
    });
    tribute.attach(document.getElementsByClassName("comment"));

  </script>
@endpush
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
                                    <i style="font-size: 1.25rem" class="like-video fas fa-heart text-danger stroke-transparent" data-id="{{ $video->id }}" data-like="true"></i> {{ $video->video_likes->count() }} &nbsp;
                                    <i style="font-size: 1.25rem" class="comment-video fas fa-comment text-white stroke-transparent"></i> {{ $video->video_comments->count() }}
                                </div>
                                @foreach ($video->video_comments as $comment)
                                <p><b><a href="{{ route('users.show', $comment->user_id) }}">{{ $comment->comment_owner->name }}</a></b> {{ $comment->comment_text }}</p>
                                @endforeach
                                <form action="{{ route('comment.store') }}" method="POST">
                                @csrf
                                <div class="form-group mt-2">
                                    <input type="hidden" name="video_id" value="{{ $video->id }}" />
                                    <textarea name="comment" class="form-control comment" placeholder="Post a comment"></textarea>
                                    <button type="submit" class="btn btn-primary">Komentar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
