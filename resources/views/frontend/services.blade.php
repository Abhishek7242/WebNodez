@extends('frontend/layouts/main')
@section('title', 'WebNodez - Services')
@section('meta_description',
    'Explore our comprehensive range of web development and digital services. From custom
    website development to mobile apps, e-commerce solutions, and IT services - we deliver innovative digital solutions for
    your business.')
@section('meta_keywords',
    'web development services, custom website development, mobile app development, e-commerce
    solutions, IT services, software development, digital solutions, web design services')
@section('og_image', asset('images/services-og-image.jpg'))
@section('services', 'active')
@section('main-section')

    <link href="{{ asset('css/services/intro.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-services.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/our-process.css') }}" rel="stylesheet">
    <link href="{{ asset('css/services/contact-page.css') }}" rel="stylesheet">
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>
    @include('frontend/services/intro')

    </header>
    @include('frontend/services/our-services')
    @include('frontend/services/our-process')
    @include('frontend/services/overview')
    {{-- @include('frontend/services/technology') --}}
    @include('frontend/services/contact-page')
    @include('frontend/services/faq')
    {{-- <section class="bg-gray-50 py-20 px-6 md:px-12">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">Ready to Start Your Project?</h2>
      <p class="text-lg text-gray-600 mb-8">
        Whether you're launching a new app, redesigning your website, or need help bringing your product to life — we're here to help. Let's build something great together.
      </p>
      <a href="/contact-us" class="inline-block bg-[var(--color-primary)] hover:bg-[var(--color-secondary)] text-white text-lg font-semibold py-3 px-8 rounded-full transition duration-300">
        Contact Us
      </a>
    </div>
  </section> --}}

    <script src="{{ asset('js/services/intro.js') }}"></script>

@endsection
