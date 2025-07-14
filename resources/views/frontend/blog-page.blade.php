@extends('frontend/layouts/main')
@section('title', 'Blogs - ' . $blog->title)
@section('meta_description',
    'Read our detailed article about ' .
    $blog->title .
    '. Discover expert insights, industry
    trends, and professional analysis from Linkuss team of specialists.')
@section('meta_keywords',
    $blog->title .
    ', web development blog, technology insights, digital solutions, industry
    trends, expert analysis, tech blog, professional insights')
@section('og_image', $blog->featured_image)
@section('blog', 'active')
@section('main-section')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/blog-page.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>

    <section class="blog-intro-section">
        <div class="container mx-auto px-4 py-16">
            <p class="text-2xl md:text-2xl font-bold text-center text-black mb-4">Blog Post</p>
            <p class="text-gray-600 text-center max-w-2xl mx-auto">Discover the latest insights, trends, and updates from our
                team of experts.</p>
        </div>
        <h1 class="text-4xl md:text-4xl text-center font-bold">{{ $blog->title }}</h1>
        {{-- <div class="blog-meta">
            <span class="blog-category">{{ $blog->category }}</span>
            <span class="blog-date">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd" />
                </svg>
                {{ $blog->created_at->format('F d, Y') }}
            </span>
            <div class="blog-author">
                <div class="author-avatar">
                    {{ substr($blog->author->name ?? 'A', 0, 1) }}
                </div>
                <span>{{ $blog->author->name ?? 'Admin' }}</span>
            </div>

        </div> --}}
        @if ($blog->featured_image)
            <div class="blog-heading-image mb-10">
                <img  src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}">
            </div>
        @endif
    </section>

    <section class="blog-content-section">
        <div class="blog-text" id="blogContent">
            {!! $blog->content !!}
        </div>
    </section>

    <section class="all-blogs">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">More Blogs</span>
                <h2 class="section-title">Discover More Stories</h2>
                <p class="section-description">Dive into our collection of articles covering technology, development, and
                    industry insights</p>
            </div>

            {{-- //blog card --}}
            <div class="flex flex-wrap justify-center gap-10">
                @foreach ($blogs->where('slug', '!=', $blog->slug)->take(4) as $innerblog)
<x-blog-card 
        :image="$innerblog->featured_image" 
        :category="$innerblog->category" 
        :title="$innerblog->title" 
        :excerpt="Str::limit(strip_tags($innerblog->content), 150)" 
        :date="$innerblog->created_at->format('F d, Y')"
            :link="'/blog/'.$innerblog -> slug"
        />
     @endforeach

                    </div>
                    </div>
                    </section>

                    {{-- lets chat with us --}}
                    <section class="lets-chat">
                    <div class="container">
                    <div class="chat-content">
                    <div class="chat-text">
                    <span class="chat-subtitle">Let's Connect</span>
                    <h2 class="chat-title">Have Questions? Let's Chat!</h2>
                    <p class="chat-description">We're here to help! Whether you have questions about our services,
                    need
                    technical support, or want to discuss your next project, our team is ready to assist you.</p>
                    <div class="chat-buttons">
                    <a href="/contact-us" class="chat-btn primary">
                    <span>Start a Conversation</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                    </svg>
                    </a>
                    <a href="mailto:support@webnodez.com" class="chat-btn secondary">
                    <span>Email Us</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                    </path>
                    <path d="m22 6-10 7L2 6"></path>
                    </svg>
                    </a>
                    </div>
                    </div>
                    <div class="chat-image">
                    <img src="https://www.shutterstock.com/image-photo/human-holding-call-center-on-600nw-2422082399.jpg"
                    alt="Let's Chat Illustration" class="floating">
                    </div>
                    </div>
                    </div>
                    </section>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const blogContent = document.getElementById('blogContent');
                            if (blogContent) {
                                // Find all images in the content
                                const images = blogContent.getElementsByTagName('img');

                                // Loop through each image and fix the src
                                Array.from(images).forEach(img => {
                                    let src = img.getAttribute('src');
                                    if (src) {
                                        // Check if the URL is not already a full URL (http/https)
                                        if (!src.startsWith('http://') && !src.startsWith('https://')) {
                                            // Remove any ../../storage prefix
                                            src = src.replace(/^\.\.\/\.\.\/storage\//, '');
                                            // Add the correct storage URL
                                            img.setAttribute('src', '/storage/' + src);
                                        }
                                    }
                                });
                            }
                        });
                    </script>
                @endsection
