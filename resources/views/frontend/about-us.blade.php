@extends('frontend/layouts/main')
@section('title', 'WebNodez - About Us')
@section('about', 'active')
@section('main-section')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link href="{{ asset('css/about/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/our-story.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/culture.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
    </script>

    @include('frontend.about-us.intro')
    @include('frontend.about-us.clients')
    @include('frontend.about-us.our-story')
    @include('frontend.about-us.mission-vision')
    @include('frontend.about-us.services')
    @include('frontend.about-us.culture')
    <script src="{{ asset('js/about.js') }}"></script>

@endsection
