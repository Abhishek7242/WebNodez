@extends('frontend/layouts/main')
@section('title', 'Linkuss - Portfolio')
@section('meta_description',
    'Explore Linkuss portfolio showcasing our web development projects, case studies, and
    design gallery. View our successful client projects, innovative solutions, and creative designs.')
@section('meta_keywords',
    'web development portfolio, case studies, design gallery, client projects, web design
    showcase, digital solutions portfolio, IT projects, software development portfolio')
@section('og_image', asset('images/portfolio-og-image.jpg'))
@section('portfolio', 'active')
@section('main-section')
    <link href="{{ asset('css/portfolio/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/case-studies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/design-gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/work-details.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/blogs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blogs.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', 'white');
    </script>


    @include('frontend/portfolio/intro')

    </header>
    @include('frontend/portfolio/case-studies')
    @include('frontend/portfolio/design-gallery')
    @include('frontend/portfolio/work-details')
    @if ($blogs->count() > 0)
        @include('frontend.portfolio.blogs')
    @endif


@endsection
