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
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header font-weight-bold">Add User</div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input type="text" name="email" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Name</label>
                        <input type="text" name="name" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password</label>
                        <input type="text" name="password" class="form-control" required/>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
            </form>
        </div>
    {{-- </div>
    <div class="row justify-content-center"> --}}
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header font-weight-bold">List User</div>
                <div class="card-body">
                    <div class="infinite-scroll">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $usr)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $usr->email }}</td>
                            <td>{{ $usr->name }}</td>
                            <td>{{ $usr->created_at }}</td>
                            <td><a href="{{ route('users.show', $usr->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
