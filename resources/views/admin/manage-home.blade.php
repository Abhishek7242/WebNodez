@extends('admin/layouts/main')
@section('title', 'Linkuss - Admin Dashboard')
@section('home', 'active')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Three.js and other required scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <!-- Canvas background container -->
    <div id="canvas-background" class="canvas-background h-100vh"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>
<section class="min-h-screen flex items-center justify-center  px-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-xl w-full text-center flex flex-col items-center">
      <img width="400px"
        src="https://i.pinimg.com/originals/df/d0/e9/dfd0e966c4c0869e8574d83ce4776261.gif" 
        alt="Welcome Image" 
        class="rounded-xl shadow-md mb-6 h-auto"
      >
      <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-2">
        🚧 Page Under Development
      </h1>
      <p class="text-gray-600 text-base md:text-lg">
        We're working hard to bring this page to life. Please check back soon!
      </p>
    </div>
  </section>
</header>  

@endsection
