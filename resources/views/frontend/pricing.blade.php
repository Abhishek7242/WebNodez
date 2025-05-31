@extends('frontend/layouts/main')
@section('title', 'Pricing - ' . $service)
@section('', 'active')
@section('main-section')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/service-details.css') }}">

    <script class="theme-script">
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#ffffff');
    </script>
    {{-- intro section --}}
    <section class="pricing-intro">
        {{-- Animated background elements --}}
        <div class="animated-background">
            <div class="blob-animation-1"></div>
            <div class="blob-animation-2 animation-delay-2000"></div>
            <div class="blob-animation-3 animation-delay-4000"></div>
            <div class="blob-animation-4 animation-delay-6000"></div>
        </div>

        {{-- Decorative grid pattern --}}
        <div class="grid-pattern"></div>

        <div class="pricing-content">
            {{-- Top badge --}}
            <div class="pricing-badge">
                <span class="pricing-badge-text">
                    <svg class="badge-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Transparent Pricing Plans
                </span>
            </div>

            {{-- Main content --}}
            <div class="pricing-header">
                <h1 class="pricing-title">{{ $service }}</h1>
                <p class="pricing-description">{{ $details['description'] }}</p>
            </div>

            {{-- Decorative elements --}}
            <div class="pricing-decoration">
                <div class="decoration-line-1"></div>
                <div class="decoration-dot"></div>
                <div class="decoration-line-2"></div>
            </div>

            {{-- Scroll indicator --}}
            <div class="scroll-indicator">
                <svg class="scroll-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <x-service-detail :serviceHeading="$service" :detailsArray='$detailsArray' />

    <section class="cta-section">
        <div class="cta-container">
            <h2 class="cta-title">Ready to Start Your Project?</h2>
            <p class="cta-description">
                Whether you're launching a new app, redesigning your website, or need help bringing your product to life —
                we're here to help. Let's build something great together.
            </p>
            <a href="/contact-us" class="cta-button">
                <span> Contact Us</span>
            </a>
        </div>
    </section>

@endsection
