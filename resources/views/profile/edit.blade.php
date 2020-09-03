@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value={{ Auth::user()->name }} required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value={{ Auth::user()->email }} required>
                        </div>
                        <div class="form-group">
                            <label for="profile-picture">Profile picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile-picture" accept="image/*" name="profile_picture">
                                <label class="custom-file-label" for="profile-picture">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small id="password-help" class="form-text text-muted">Only fill this in if you want to change it</small>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm password</label>
                            <input type="password" class="form-control {{ Session::has('mismatch') ? 'is-invalid' : null}}" id="password-confirm" name="password_confirm">
                            @if (Session::has('mismatch'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ Session::get('mismatch') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-primary" href="{{ route('profile.index') }}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
