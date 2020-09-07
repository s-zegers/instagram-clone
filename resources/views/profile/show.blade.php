@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center mb-3">
                @if (isset($user->profile_picture))
                    <img src="{{ asset("storage/$user->profile_picture") }}" alt="Profile picture" class="rounded-circle profile-picture" style="height: 64px; width: 64px;">
                @else
                    <img src="{{ asset('images/default-user-icon.jpg') }}" alt="Profile picture" height="64" class="rounded-circle">
                @endif
                <h1 class="ml-2 mb-0">{{ $user->name }}</h1>
            </div>
            @if ($user->follower_list->count() > 0)
                <p class="mb-1"><b>Bio:</b> Coming soon</p>
                <a href="#" data-toggle="modal" data-target="#followers-modal">
                    <b>Followers:</b> {{ count($user->follower_list) }}
                </a>
                <div class="modal fade" id="followers-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">These people follow {{ $user->name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @foreach ($followers as $follower)
                                    <div class="d-flex align-items-center mb-3">
                                        @if (isset($follower->profile_picture))
                                            <img src="{{ asset("storage/$follower->profile_picture") }}" alt="Profile picture" class="rounded-circle profile-picture" style="height: 32px; width: 32px;">
                                        @else
                                            <img src="{{ asset('images/default-user-icon.jpg') }}" alt="Profile picture" height="32" class="rounded-circle">
                                        @endif
                                        <h4 class="ml-2 mb-0"><a href="/profile/{{ $follower->id }}">{{ $follower->name }}</a></h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="mb-1"><b>Bio:</b> Coming soon</p>
                <span class="mb-1"><b>Followers:</b> {{ count($user->follower_list) }}</span>
            @endif
            @if (Auth::user()->id !== $user->id)
                <div>
                    @if (! $user->follower_list->contains(Auth::user()->id))
                        <form action="{{ route('profile.follow', $user->id) }}" method="POST" id="follow-profile-form" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-2" onclick="event.preventDefault();
                                document.getElementById('follow-profile-form').submit();">Follow</button>
                        </form>
                    @else
                        <form action="{{ route('profile.unfollow', $user->id) }}" method="POST" id="unfollow-profile-form" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger mt-2" onclick="event.preventDefault();
                                document.getElementById('unfollow-profile-form').submit();">Unfollow</button>
                        </form>
                    @endif
                </div>
            @endif
            @if (count($user->stories->where('created_at', '>', now()->subDay(1))) > 1)
                <div id="stories" class="my-3">
                    @foreach ($user->stories as $story)
                        <img src="{{ asset("storage/$story->image") }}" alt="Story image" data-toggle="modal" data-target="#story-modal-{{ $story->id }}">
                        <div class="modal fade" id="story-modal-{{ $story->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close position-absolute modal-close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <img src="{{ asset("storage/$story->image") }}" alt="Story image" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @forelse ($user->posts->sortByDesc('created_at') as $post)
                @php
                    $post->user = json_decode($user);
                @endphp
                <post-card :post="{{ $post }}" :user="{{ Auth::user() }}"
                    show-route="{{ route('profile.show', $user->id) }}"
                    delete-route="{{ route('posts.destroy', $post->id) }}"></post-card>
            @empty
                <p>This user has no posts yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
