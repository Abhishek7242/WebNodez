@extends('frontend/layouts/main')
@section('title', 'About Linkuss | Web Development & Digital Solutions Team')
@section('meta_description',
    'Meet Linkuss: Expert web development, digital solutions, and a passionate team driving
    innovation for your business.')
@section('meta_keywords',
    'about linkuss, company story, mission vision, company culture, web development team, digital
    solutions company, IT services company, professional team')
@section('og_image', asset('images/about-og-image.jpg'))

@section('organization_schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "AboutPage",
            "name": "About Linkuss",
            "description": "Meet Linkuss: Expert web development, digital solutions, and a passionate team driving innovation for your business.",
            "url": "{{ url()->current() }}",
            "image": "{{ asset('images/about-og-image.jpg') }}",
            "mainEntity": {
                "@type": "Organization",
                "name": "Linkuss",
                "url": "https://linkuss.com",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://linkuss.com/assets/favicon/logo.png"
                },
                "sameAs": [
                    "https://x.com/Linkuss?t=kPl0_8r4R6vYPkBK_JAKww&s=09",
                    "http://www.linkedin.com/in/linkuss-digital-solutions-8b014537b",
                    "https://www.facebook.com/linkuss",
                    "https://www.instagram.com/_linkuss?igsh=Z3k5dzlvNWYzeXRq"
                ]
            }
        }
        </script>
@endsection
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
