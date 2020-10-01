@extends('layouts.app')

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
            <div class="card">
                <div class="card-header font-weight-bold">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($videos as $vid)
                        <div class="col-sm-4 d-flex justify-content-center">
                            {{-- <div class="embed-responsive"> --}}
                            <video class="embed-responsive-item" width="300" controls>
                                <source src="{{ asset('storage/'.$vid->path) }}">
                            </video>
                            {{-- </div> --}}
                        </div>
                        @if($loop->iteration % 3 == 0)
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
