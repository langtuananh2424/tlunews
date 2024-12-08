@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($news as $new)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $new->image }}" class="card-img-top" alt="{{ $new->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $new->title }}</h5>
                            <p class="card-text">{{ $new->short_description }}</p>
                            <a href="{{ route('news.show', $new->id) }}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection