@extends('layouts.app', ['title' => 'List Users'])
@push('js')
<script>
    $('.open-video').on('click', function(){
        window.location = $(this).attr('data-url');
    });
    $('.btn-hapus').on('click', function(){
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
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row justify-content-center mb-3">
        <div class="col-4 d-flex justify-content-end">
            <img src="{{ asset('user.png') }}" class="text-center" style="max-height: 100px"/>
            <input type="file" name="upload_photo" accept="image/*" />
        </div>
        <div class="col-8">
            <div class="form-group">
                <label class="font-weight-bold">Email</label>
                <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" required/>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Name</label>
                <input type="text" name="name" class="form-control" value="{{{ Auth::user()->name }}}" required/>
            </div>
            {{-- <div class="form-group">
                <label class="font-weight-bold">Password</label>
                <input type="text" name="password" class="form-control" required/>
            </div> --}}
            <button type="submit" class="btn btn-success">Update</button>
        </div>   
    </div>
    </form>
</div>

@endsection
