@extends('frontend/layouts/main')
@section('title', 'WebNodez - Home')
@section('home', 'active')
@section('main-section')

        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home/services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/technologies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/pricing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/why-us.css') }}" rel="stylesheet">
    
    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'none'); // Remove the background image since we're using canvas
    </script>
    @include('frontend/home/intro')

    </header>

    @include('frontend/home/services')
    @include('frontend/home/technologies')
    @include('frontend/home/our-process')
    @include('frontend/home/portfolio')
    @include('frontend/home/why-us')
    @include('frontend/home/pricing')

    <script src="{{ asset('js/home.js') }}"></script>
@endsection
