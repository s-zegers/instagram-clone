@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Feed</div>
                <div class="card-body">
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
                                            <div class="position-absolute modal-author">Story by <a href="{{ route('profile.show', $story->user->id) }}">{{ $story->user->name }}</a></div>
                                            <img src="{{ asset("storage/$story->image") }}" alt="Story image" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @forelse ($posts as $post)
                        <div class="card mb-3">
                            @isset($post->image)
                                <img class="card-img-top" src="{{ asset("storage/$post->image") }}" alt="Card header">
                            @endisset
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $post->title }}
                                </h5>
                                <p class="card-text">{{ $post->description }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                Posted by <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>                 
                                <div class="float-right">
                                    {{ $post->created_at->diffForHumans() }}
                                    @if ($post->user_id == Auth::user()->id)
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete" />
                                            <a onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $post->id }}').submit();">❌</a>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>There are currently no posts 😞</p>
                    @endforelse
                    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
