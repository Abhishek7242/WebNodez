@extends('frontend/layouts/main')
@section('title', 'Services - ' . $service)

@section('services', 'active')
@section('main-section')
<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://upload.wikimedia.org/wikipedia/commons/8/8b/Green.gif')`);

 </script>
<section class="relative py-20 px-6 md:px-16">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{$service}}</h1>
      <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
       {{ $details['description']}}
      </p>
    </div>
  </section>
    
    </header>
    <x-service-detail :serviceHeading="$service" :detailsArray='$detailsArray' />
 
    <section class="bg-gray-50 py-20 px-6 md:px-12">
        <div class="max-w-4xl mx-auto text-center">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Ready to Start Your Project?</h2>
          <p class="text-lg text-gray-600 mb-8">
            Whether you're launching a new app, redesigning your website, or need help bringing your product to life — we're here to help. Let’s build something great together.
          </p>
          <a href="/contact-us" class="inline-block bg-[var(--color-primary)] hover:bg-[var(--color-secondary)] text-white text-lg font-semibold py-3 px-8 rounded-full transition duration-300">
            Contact Us
          </a>
        </div>
      </section>
      


@endsection