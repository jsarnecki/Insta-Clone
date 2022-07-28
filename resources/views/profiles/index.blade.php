@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img class="first" alt="profile image" src="/storage/{{ $user->profile->image }}">
        </div>
        <div class="description-box col-9">
            <div class="profile-title-container">
                <h1>{{ $user -> username }}</h1>

                @can('update', $user->profile) {{-- Adds auth so only logged in user can add new post\ --}}
                    <a href="/p/create">Add New Post</a>
                @endcan


            </div>

            @can('update', $user->profile) {{-- Adds auth so only logged in user can edit --}}
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="count-description">
                <div class="count-description-item"><strong>{{ $user->posts->count() }}</strong> posts</div>
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
                    <a href="/p/{{$post->id}}">
                        <img class="dashboard-img" src="/storage/{{ $post->image }}">
                    </a>
                </div>
            @endforeach

        </div>

    </div>
</div>
@endsection
