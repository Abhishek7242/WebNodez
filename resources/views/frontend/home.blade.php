@extends('frontend/layouts/main')
@section('title', 'WebNodez - Home')
@section('home', 'active')
@section('main-section')
<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://w0.peakpx.com/wallpaper/251/431/HD-wallpaper-black-with-green-background-technology-other-entertainment-people.jpg')`);

 </script>
   @include('frontend/home/intro') 
    
    </header>

    @include('frontend/home/services')
    @include('frontend/home/technologies')
    @include('frontend/home/our-process')
    @include('frontend/home/pricing')

<script src="{{ asset('js/home.js') }}"></script>
@endsection