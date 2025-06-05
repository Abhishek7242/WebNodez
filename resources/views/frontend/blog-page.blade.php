@extends('frontend/layouts/main')
@section('title', 'WebNodez - Blog')
@section('blog', 'active')
@section('main-section')
    <link href="{{ asset('css/blog-page.css') }}" rel="stylesheet">

    @php
        $data = '
    <h2>i am blog title</h2>

        '
    @endphp

   <script>
  
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
        
    </script>

    <section class="blog-intro-section">
        <div class="container mx-auto px-4 py-16">
            <p class="text-2xl md:text-2xl font-bold text-center text-black mb-4"> Blog - Post</p>
            <p class="text-gray-300 text-center max-w-2xl mx-auto">Discover the latest insights, trends, and updates from our
                team of experts.</p>
        </div>
        <h1 class="text-4x1 md:text-4xl text-center font-bold">{{ $blog->title }}</h1>
        <div class="rounded-3 overflow-hidden bg-black blog-heading-image mt-12">
            <img class="w-100" src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" >
        </div>
      
    </section>
</header>

    <section class="blog-content-section py-16">
        {!! $blog->content !!}
    </section>

@endsection
