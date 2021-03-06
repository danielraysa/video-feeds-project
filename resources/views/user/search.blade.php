@extends('layouts.app', ['title' => 'Search'])
@push('js')
<script>
    $('.open-video').on('click', function(){
        window.location = $(this).attr('data-url');
    });
    $('#search_box').keyup(function(){
        var link = "{{ route('search') }}";
        var text = $(this).val();
        /* $.ajax({
            url: link,
            type: 'get',
            data: {filter: text},
            success: function(result){
                alert(result);
                console.log(result);
            }
        }); */
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
                $('.open-video').on('click', function(){
                    window.location = $(this).attr('data-url');
                });
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
                <div class="card-header font-weight-bold">Search</div>
                <div class="card-body">
                {{-- <div class="row"> --}}
                <form action="{{ route('search') }}" method="GET">
                <div class="form-inline mb-3">
                    <input type="search" class="col-lg-11 col-10 form-control" id="search_box" name="filter" placeholder="Search..." @if(isset($_GET['filter'])) value="{{ $_GET['filter'] }}" @endif/>
                    <button type="submit" class="col-lg-1 col-2 btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
                </form>
                <div class="infinite-scroll">
                    <div class="row" id="content_dynamic">
                        @foreach($videos as $vid)
                        <div class="col-sm-4">
                            @if($vid->thumbnail_path != null)
                            <img class="open-video" style="width: 100%" src="{{ asset('storage/'.$vid->thumbnail_path) }}" data-url="{{ route('videos.show', $vid->id) }}" />
                            @else
                            {{-- <video class="embed-responsive-item open-video" data-toggle="modal" data-target="#modalVideo" style="width: 100%" autoplay muted> --}}
                            <video class="embed-responsive-item open-video" data-url="{{ route('videos.show', $vid->id) }}" style="width: 100%">
                                <source src="{{ $vid->video_url() }}">
                            </video>
                            @endif
                            {{-- <div class="mt-2">
                                <i style="font-size: 1.25rem" class="like-video fas fa-heart text-danger stroke-transparent" data-id="{{ $vid->id }}" data-like="true"></i> 40 &nbsp;
                                <i style="font-size: 1.25rem" class="comment-video fas fa-comment text-white stroke-transparent" data-url="{{ route('videos.show', $vid->id) }}"></i> 23
                            </div> --}}
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
