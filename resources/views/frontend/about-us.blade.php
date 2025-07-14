@extends('frontend/layouts/main')
@section('title', 'Linkuss - About Us')
@section('meta_description',
    'Learn about Linkuss - our story, mission, vision, and company culture. Discover how we
    deliver innovative web development and digital solutions with a team of expert professionals.')
@section('meta_keywords',
    'about webnodez, company story, mission vision, company culture, web development team, digital
    solutions company, IT services company, professional team')
@section('og_image', asset('images/about-og-image.jpg'))
@section('about', 'active')
@section('main-section')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link href="{{ asset('css/about/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/our-story.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/culture.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/clients.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/mission-vision.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about/services.css') }}" rel="stylesheet">
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
    </script>

    @include('frontend.about-us.intro')
    </header>
    @include('frontend.about-us.clients')
    @include('frontend.about-us.our-story')
    @include('frontend.about-us.mission-vision')
    @include('frontend.about-us.services')
    @include('frontend.about-us.culture')
    <script src="{{ asset('js/about.js') }}"></script>

@endsection
