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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
