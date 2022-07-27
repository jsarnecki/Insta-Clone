@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img class="first" alt="first image added" src="https://external-preview.redd.it/QJR9EFbelLAg4a8DfHwFF7PJO1lIFWkda9mB81WJUow.jpg?width=640&crop=smart&auto=webp&s=baf5ef7ccdd714fb30ff8255360fff5286b809f3">
        </div>
        <div class="description-box col-9">
            <div class="profile-title-container">
                <h1>{{ $user -> username }}</h1>
                <a href="/p/create">Add New Post</a>
            </div>
            <div class="count-description">
                <div class="count-description-item"><strong>123</strong> posts</div>
                <div class="count-description-item"><strong>43k</strong> followers</div>
                <div class="count-description-item"><strong>212</strong> following</div>
            </div>
            <div class="pt-4"><strong>{{ $user->profile->title }}</strong></div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url  }}</a></div>
        </div>

        <div class="row image-container">

            @foreach($user->posts as $post)
                <div class="col-4">
                    <img class="dashboard-img" src="/storage/{{ $post->image }}">
                </div>
            @endforeach

        </div>

    </div>
</div>
@endsection
