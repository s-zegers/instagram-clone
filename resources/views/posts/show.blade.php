@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">A post by {{ $post->user->name }}</div>
                <div class="card-body">
                    @if ($post->image)
                        <img src="{{ asset("storage/$post->image") }}" alt="WOW" class="img-fluid mb-3 rounded">
                    @endif
                    <h1>{{ $post->title }}</h1>
                    <p class="mb-0">{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
