@extends('layouts.app', ['title' => 'My Videos'])
@push('js')
<script>
    $('.open-video').on('click', function(){
        window.location = $(this).attr('data-url');
    });
    $('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<img class="center-block" src="{{ asset('loading.gif') }}" alt="Loading..." />',
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
    <div class="row justify-content-center mb-3">
        <div class="col-4 d-flex justify-content-end">
            <img src="{{ asset('user.png') }}" class="text-center" style="max-height: 100px"/>
        </div>
        <div class="col-8">
            <p><b>{{ $user->name }}</b></p>
            <p>{{ $user->email }}</p>
        </div>
    </div>
    <div class="row justify-content-center mb-3">
        <div class="col-sm-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header font-weight-bold">{{ $user->name }}'s Videos</div>
                <div class="card-body">
                    <div class="infinite-scroll">
                    <div class="row">
                        @foreach($videos as $vid)
                        <div class="col-sm-4 mb-3">
                            @if($vid->thumbnail_path != null)
                            <img class="open-video" style="width: 100%" src="{{ asset('storage/'.$vid->thumbnail_path) }}" data-url="{{ route('videos.show', $vid->id) }}" />
                            @else
                            <video class="embed-responsive-item open-video" data-url="{{ route('videos.show', $vid->id) }}" style="width: 100%" muted loop>
                                <source src="{{ asset('storage/'.$vid->path) }}">
                            </video>
                            @endif
                        </div>
                        @if($loop->iteration % 3 == 0)
                    </div>
                    <div class="row">
                        @endif
                    @endforeach
                    </div>
                    {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formHapus" action="" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <div class="font-weight-bold">Peringatan</div>
            </div>
            <div class="modal-body">
                Yakin mau hapus video? Video akan dihapus secara permanen
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary"> Batal</button>
                <button type="submit" class="btn btn-danger"> Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
