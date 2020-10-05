@extends('layouts.app', ['title' => 'Home'])
@push('js')
<script>
    $('.open-video').on('click', function(){
        /* var link = $(this).children('source').attr("src");
        $('#videoModal').attr('src', link); */
        window.location = $(this).attr('data-url');
    });
    $('#modalVideo').on('hidden.bs.modal', function(){
        $(this).find('video')[0].pause();
    });

    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="loading.gif" alt="Loading..." />',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header font-weight-bold">Dashboard</div>
                <div class="card-body">
                <div class="infinite-scroll">
                    <div class="row" id="content_dynamic">
                        @foreach($videos as $vid)
                        <div class="col-sm-4">
                            @if($vid->thumbnail_path != null)
                            <img class="open-video" style="width: 100%" src="{{ asset('storage/'.$vid->thumbnail_path) }}" data-url="{{ route('videos.show', $vid->id) }}" />
                            @else
                            {{-- <video class="embed-responsive-item open-video" data-toggle="modal" data-target="#modalVideo" style="width: 100%" autoplay muted> --}}
                            <video class="embed-responsive-item open-video" data-url="{{ route('videos.show', $vid->id) }}" style="width: 100%">
                                <source src="{{ asset('storage/'.$vid->path) }}">
                            </video>
                            @endif
                            <p class="mb-0"><b>{{ $vid->filename }}</b></p>
                            <p class="mb-3" style="font-size: 0.85rem"><a href="{{ route('users.show', $vid->video_owner->id) }}">&#64;{{ $vid->video_owner->name }}</a> — {{ $vid->description }}</p>
                        </div>
                        @endforeach
                    </div>
                    {{ $videos->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalVideo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <video id="videoModal" class="embed-responsive-item" style="width: 100%" autoplay controls loop>
                </video>
            </div>
        </div>
    </div>
</div>
@endsection
