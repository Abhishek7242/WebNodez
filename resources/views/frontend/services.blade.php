@extends('frontend/layouts/main')
@section('title', 'WebNodez - Services')
@section('services', 'active')
@section('main-section')
<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://i.pinimg.com/originals/3d/28/37/3d2837a1c5e612fa8ca7dd9c587a7118.gif')`);

 </script>
@include('frontend/services/intro')
      
    </header>
@include('frontend/services/overview')
@include('frontend/services/technology')
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