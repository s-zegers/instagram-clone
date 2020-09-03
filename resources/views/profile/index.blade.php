@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <h1>Account information</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Name</th>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Password</th>
                                <td>******</td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="btn btn-success">View profile ✨</a>
                    <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-primary">Edit profile 📁</a>
                    <form action="{{ route('profile.destroy', Auth::user()->id) }}" method="POST" id="delete-profile-form" class="d-inline">
                        @csrf
                        <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="btn btn-danger" onclick="event.preventDefault();
                            document.getElementById('delete-profile-form').submit();">Delete profile 😢</button>
                    </form>
                    <h1 class="mt-3">Your posts</h1>
                    {{-- Get these cards next to each other --}}
                    @forelse (Auth::user()->posts->sortByDesc('created_at') as $post)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Details</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" id="delete-form-{{ $post->id }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button class="btn btn-danger" onclick="event.preventDefault();
                                        document.getElementById('delete-form-{{ $post->id }}').submit();">Delete</button>
                                </form>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="float-right">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>You don't have any posts yet</div>
                    @endforelse
                    <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">Create a new post 📫</a>
                    <a href="{{ route('stories.create') }}" class="btn btn-primary mt-2">New story 📸</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
