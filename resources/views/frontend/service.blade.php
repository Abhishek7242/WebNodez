@extends('frontend/layouts/main')
@section('title', 'Services - ' . $service)
@section('meta_description', 'Discover our professional ' . $service . ' services. ' . $details['description'])
@section('meta_keywords',
    $service .
    ', web development, digital solutions, IT services, software development, custom
    solutions, professional services, technology solutions, business solutions, enterprise solutions')
@section('og_image', asset('images/services/' . strtolower(str_replace(' ', '-', $service)) . '-og.jpg'))
@section('services', 'active')
@section('main-section')
    <link rel="stylesheet" href="{{ asset('css/service/intro.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/service/service-overview.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/service/technology.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components/service-details.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components/why-choose-us.css') }}?v={{ time() }}">
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', 'white');
    </script>
    {{-- <section class="relative py-20 px-6 md:px-16">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{$service}}</h1>
      <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
       {{ $details['description']}}
      </p>
    </div>
  </section> --}}



    @include('frontend/service/intro')
    </header>
    {{-- service overview --}}
    @include('frontend/service/service-overview')
    {{-- Why web dev is solution  --}}
    <x-service-detail :serviceHeading="$service" :detailsArray='$detailsArray' />
    {{-- Tech we use section --}}
    @include('frontend/service/technology')
    {{-- Tech we use section --}}
    <x-why-choose-us :projectNumber='$projectNumber' :clientSatis="98" />

    @include('frontend/services/contact-page')

    <x-faq :faqs='$faqsArray' />


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



@endsection
