@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New story</div>
                <div class="card-body">
                    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" accept="image/*" name="image">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <img id="image-preview" class="img-fluid mb-3">
                        <button type="submit" class="btn btn-primary">Create story 🎉</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
