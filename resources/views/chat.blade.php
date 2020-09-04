@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Live chat!</div>
                <div class="card-body">
                   <chat :user="{{ Auth::user() }}"></chat>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection