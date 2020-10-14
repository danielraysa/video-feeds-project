@extends('layouts.app', ['title' => 'My Videos'])
@push('js')
<script>
    $('.open-video').on('click', function(){
        window.location = $(this).attr('data-url');
    });
    $('.btn-hapus').on('click', function(){
        /* var link = $(this).children('source').attr("src");
        $('#videoModal').attr('src', link); */
        $('#formHapus').attr('action', $(this).attr('data-url'));
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
        <div class="col-md-4 col-sm-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header font-weight-bold">Upload Video</div>

                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" name="filename" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Description</label>
                        <textarea name="description" class="form-control" rows="4"required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Upload file</label>
                        <input type="file" accept="video/*" name="upload_file" class="form-control" required/>
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
                <div class="card-header font-weight-bold">My Videos</div>
                <div class="card-body">
                    <div class="infinite-scroll">
                    <div class="row">
                        @foreach($videos as $vid)
                        <div class="col-sm-6 mb-3">
                            @if($vid->thumbnail_path != null)
                            <img class="open-video" style="width: 100%" src="{{ asset('storage/'.$vid->thumbnail_path) }}" data-url="{{ route('videos.show', $vid->id) }}" />
                            @else
                            <video class="embed-responsive-item open-video" data-url="{{ route('videos.show', $vid->id) }}" style="width: 100%" autoplay muted loop>
                                <source src="{{ $vid->video_url() }}">
                            </video>
                            @endif
                            <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('videos.edit', $vid->id) }}" class="btn btn-warning mr-2 text-white">Edit</a>
                            <button class="btn btn-danger btn-hapus" data-toggle="modal" data-target="#modalDelete" data-url="{{ route('videos.destroy', $vid->id) }}">Delete</button>
                            </div>
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
