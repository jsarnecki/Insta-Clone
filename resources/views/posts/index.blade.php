@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="row">
            <div class="col-8 offset-4">
                <a href="/profile/{{ $post->user->id }}">
                    <img src="/storage/{{ $post->image }}" alt="{{$post->caption}}">
                </a>
            </div>
        </div>
    <div class="row pt-2 pb-4">
            <div class="col-8 offset-4">
                <div>

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
    @endforeach

        <div class="row">
            <div class="col-9">
                {{ $posts->links() }}
            </div>
        </div>

</div>
@endsection
