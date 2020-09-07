@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if(count($stories) > 0)
                <div id="stories" class="mb-3">
                    @foreach ($stories as $story)
                        <img src="{{ asset("storage/$story->image") }}" alt="Story image" data-toggle="modal" data-target="#story-modal-{{ $story->id }}">
                        <div class="modal fade" id="story-modal-{{ $story->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close position-absolute modal-close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="position-absolute modal-author">
                                        Story by <a href="{{ route('profile.show', $story->user->id) }}" class="animated-text">{{ $story->user->name }}</a>
                                    </div>
                                    <img src="{{ asset("storage/$story->image") }}" alt="Story image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @forelse ($posts as $post)
                <post-card :post="{{ $post }}" :user="{{ Auth::user() }}"
                    show-route="{{ route('profile.show', $post->user->id) }}"
                    delete-route="{{ route('posts.destroy', $post->id) }}"></post-card>
            @empty
                <p>There are currently no posts 😞</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
