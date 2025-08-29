@section('organization_schema')
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "Linkuss Portfolio | Web Development, Case Studies & Design Gallery",
    "description": "See Linkuss portfolio: web, UI/UX, e-commerce, and digital projects for real client results.",
    "url": "{{ url()->current() }}",
    "image": "{{ asset('images/portfolio-og-image.jpg') }}",
    "mainEntity": [
        {
            "@type": "CreativeWorkSeries",
            "name": "Web Development Projects",
            "description": "Custom websites, web apps, and digital platforms built for clients across industries.",
            "url": "{{ url('/portfolio') }}"
        },
        {
            "@type": "CreativeWorkSeries",
            "name": "Case Studies",
            "description": "In-depth stories of business challenges solved by Linkuss with technology and design.",
            "url": "{{ url('/portfolio') }}#case-studies"
        },
        {
            "@type": "CreativeWorkSeries",
            "name": "Design Gallery",
            "description": "Showcase of UI/UX, branding, and creative work for digital products.",
            "url": "{{ url('/portfolio') }}#design-gallery"
        }
    ],
    "publisher": {
        "@type": "Organization",
        "name": "Linkuss",
        "url": "https://linkuss.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://linkuss.com/assets/favicon/logo.png"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "Customer Service",
            "email": "support@linkuss.com",
            "areaServed": "Global",
            "availableLanguage": ["English", "Hindi"]
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
@extends('frontend/layouts/main')
@section('title', 'Portfolio | Linkuss - Web Development, Case Studies & Design Gallery')
@section('meta_description', 'See Linkuss portfolio: web, UI/UX, e-commerce, and digital projects for real client
    results.')
@section('meta_keywords',
    'web development portfolio, case studies, design gallery, client projects, web design
    showcase, digital solutions, IT projects, software development, Linkuss portfolio, creative work')
@section('og_image', asset('images/portfolio-og-image.jpg'))


@section('portfolio', 'active')
@section('main-section')
    <link href="{{ asset('css/portfolio/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/case-studies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/design-gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/work-details.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/blogs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio/testimonials.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blogs.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', 'white');



          document.addEventListener('DOMContentLoaded', function() {
            const loadingIndicator = document.querySelector('.loading-indicator');

          

            // Handle blog card image loading
            const blogCardImages = document.querySelectorAll('.blog-container img');
            blogCardImages.forEach(function(img) {
                const imageWrapper = img.closest('.blog-image-wrapper');
                const loadingIndicator = imageWrapper.querySelector('.card-loading-indicator');

                if (img.complete) {
                    img.classList.add('loaded');
                    imageWrapper.classList.add('loaded');
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'none';
                    }
                } else {
                    img.addEventListener('load', function() {
                        this.classList.add('loaded');
                        imageWrapper.classList.add('loaded');
                        if (loadingIndicator) {
                            loadingIndicator.style.opacity = '0';
                            setTimeout(() => {
                                loadingIndicator.style.display = 'none';
                            }, 300);
                        }
                    });
                    img.addEventListener('error', function() {
                        // Fchallback for failed image load
                        this.style.display = 'none';
                        if (loadingIndicator) {
                            loadingIndicator.innerHTML =
                                '<div class="card-loading-text">Image unavailable</div>';
                        }
                    });
                }
            });
        });
    </script>


    @include('frontend/portfolio/intro')

    </header>
    @include('frontend/portfolio/case-studies')
    @include('frontend/portfolio/design-gallery')
    @include('frontend/portfolio/work-details')
    @include('frontend/portfolio/testimonials')
    @if ($blogs->count() > 0)
        @include('frontend.portfolio.blogs')
    @endif


@endsection
