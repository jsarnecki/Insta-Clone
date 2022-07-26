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
            <div><h1>{{ $user -> username }}</h1></div>
            <div class="count-description">
                <div class="count-description-item"><strong>123</strong> posts</div>
                <div class="count-description-item"><strong>43k</strong> followers</div>
                <div class="count-description-item"><strong>212</strong> following</div>
            </div>
            <div class="pt-4"><strong>website name here</strong></div>
            <div> lorem ipsum description for account here.. and here let me just type some more random shit to make this even longer than is necessary okay great </div>
            <div><a href="#">link to website here</a></div>
        </div>

        <div class="row image-container">
            <div class="col-4">
               <img class="dashboard-img" src="https://i.pinimg.com/originals/cc/57/a7/cc57a7094af5c1f4abfcd44808ebaf28.jpg">
            </div>
            <div class="col-4">
                <img class="dashboard-img" src="https://i.pinimg.com/736x/9e/c0/ba/9ec0ba556cc68b9c51801cb08f338039--doona-bae.jpg">
            </div>
            <div class="col-4">
                <img class="dashboard-img" src="https://nsbb.in/wp-content/uploads/2022/03/Bae-Doona-Biography-Actress-Wiki-Age-Boyfriend-Family-Facts-810x731.jpg">
            </div>
        </div>

    </div>
</div>
@endsection
