@section('organization_schema')
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Linkuss",
    "url": "https://linkuss.com",
    "description": "Linkuss is a leading web development and digital solutions company. We offer professional web design, development, and IT services to help businesses grow online.",
    "publisher": {
        "@type": "Organization",
        "name": "Linkuss",
        "logo": {
            "@type": "ImageObject",
            "url": "https://linkuss.com/assets/favicon/logo.png"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "Customer Service",
            "email": "support@linkuss.com",
            "areaServed": "Global",
            "availableLanguage": "English,Hindi"
        },
        "sameAs": [
            "https://twitter.com/linkuss",
            "http://www.linkedin.com/in/linkuss-digital-solutions-8b014537b",
            "https://www.facebook.com/linkuss"
        ]
    },
    "potentialAction": {
        "@type": "SearchAction",
        "target": "https://linkuss.com/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
@endsection
@extends('frontend/layouts/main')
@section('title', 'Linkuss | Web Development, Digital Solutions & IT Services')
@section('meta_description', 'Web development, digital solutions, and IT services for business growth. Linkuss delivers
    results.')
@section('meta_keywords',
    'web development, web design, digital solutions, IT services, software development, mobile
    apps, custom websites, e-commerce solutions')
@section('og_image', asset('images/home-og-image.jpg'))
@section('home', 'active')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">

    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/technologies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/why-us.css') }}" rel="stylesheet">

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white'); // Remove the background image since we're using canvas
        el.style.setProperty('--dark-bg', 'white'); // Remove the background image since we're using canvas
    </script>
    @include('frontend/home/intro')

    </header>

    @include('frontend/home/services')
    @include('frontend/home/technologies')
    {{-- @include('frontend/home/our-process') --}}
    @include('frontend/home/portfolio')
    @include('frontend/home/why-us')

    <script src="{{ asset('js/home.js') }}"></script>
@endsection
