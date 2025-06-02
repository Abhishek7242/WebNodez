@extends('frontend/layouts/main')
@section('title', 'WebNodez - Portfolio')
@section('portfolio', 'active')
@section('main-section')
    <link href="{{ asset('css/portfolio/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/case-studies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/design-gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/work-details.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/blogs.css') }}" rel="stylesheet">
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', 'linear-gradient(135deg, #f0fff4, #ffffff)');
    </script>


    @include('frontend/portfolio/intro')
    
</header>
@include('frontend/portfolio/case-studies')
@include('frontend/portfolio/design-gallery')
@include('frontend/portfolio/work-details')
@include('frontend/portfolio/blogs')

@endsection