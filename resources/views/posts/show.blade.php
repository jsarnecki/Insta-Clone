@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="container">
  <div class="row">
      <div class="col-8">
          <img src="/storage/{{ $post->image }}" alt="{{$post->caption}}">
      </div>
      <div class="col-4">
          <div>
              <div class="show-title-container">
                  <div class="profile-img-small-container">
                      <img class="profile-img-small" src="{{ $post->user->profile->profileImage() }}" alt="{{$post->caption}}">
                  </div>
                  <div>
                      <div>
                          <a href="/profile/{{ $post->user->id }}">
                              <span class="a-tag-dark">
                                  <strong>{{ $post->user->username }}</strong>
                              </span>
                          </a>
                          <a href="#" class="follow-btn">Follow</a>
                      </div>
                  </div>
              </div>

              <hr>

              <p>
                  <span>
                      <a href="/profile/{{ $post->user->id }}">
                          <span class="a-tag-dark">
                              <strong>{{ $post->user->username }}</strong>
                          </span>
                      </a>
                  </span>
                    {{ $post->caption }}
                  </span>
              </p>
          </div>
      </div>
  </div>
</div>
@endsection
