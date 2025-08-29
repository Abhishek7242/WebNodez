@section('organization_schema')
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Blog",
    "name": "Linkuss Blog: Web Development, Technology Trends & Digital Solutions",
    "description": "Discover the Linkuss Blog for expert articles, tutorials, and the latest trends in web development, technology, and digital solutions. Stay updated with industry insights and professional tips from our team.",
    "url": "{{ url()->current() }}",
    "image": "{{ asset('images/blogs-og-image.jpg') }}",
    "publisher": {
        "@type": "Organization",
        "name": "Linkuss",
        "logo": {
            "@type": "ImageObject",
            "url": "https://linkuss.com/assets/favicon/logo.png"
        },
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "IN",
            "addressLocality": "New Delhi",
            "postalCode": "110001",
            "streetAddress": "A-123, Connaught Place"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "Customer Service",
            "email": "support@linkuss.com",
            "areaServed": "Global",
            "availableLanguage": "English,Hindi"
        },
        "sameAs": [
            "https://twitter.com/linkuss",
            "http://www.linkedin.com/in/linkuss-digital-solutions-8b014537b",
            "https://www.facebook.com/linkuss"
        ]
    }
}
</script>
@endsection
@extends('frontend/layouts/main')
@section('title', 'Linkuss Blog: Web Development, Technology Trends & Digital Solutions')
@section('meta_description', 'Linkuss Blog: Web development tips, tech trends, and digital solutions for businesses.
    Expert insights and tutorials.')
@section('meta_keywords',
    'web development blog, technology trends, digital solutions, web design, IT industry, software
    development, tech tutorials, industry insights, Linkuss blog, expert articles')
@section('og_image', asset('images/blogs-og-image.jpg'))
@section('blog', 'active')
@section('main-section')
    <link href="{{ asset('css/blogs.css') }}" rel="stylesheet">

    <!-- Preload hero image for faster loading -->
    <link rel="preload" as="image" href="{{ asset('assets/blog-intro-img.png') }}" fetchpriority="high">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');

        // Handle hero image loading
        document.addEventListener('DOMContentLoaded', function() {
            const heroImage = document.querySelector('.blog-hero-image img');
            const heroImageContainer = document.querySelector('.blog-hero-image');
            const loadingIndicator = document.querySelector('.loading-indicator');

            if (heroImage) {
                if (heroImage.complete) {
                    heroImage.classList.add('loaded');
                    heroImageContainer.classList.add('loaded');
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'none';
                    }
                } else {
                    heroImage.addEventListener('load', function() {
                        this.classList.add('loaded');
                        heroImageContainer.classList.add('loaded');
                        if (loadingIndicator) {
                            loadingIndicator.style.opacity = '0';
                            setTimeout(() => {
                                loadingIndicator.style.display = 'none';
                            }, 300);
                        }
                    });
                    heroImage.addEventListener('error', function() {
                        // Fallback for failed image load
                        this.style.display = 'none';
                        if (loadingIndicator) {
                            loadingIndicator.innerHTML =
                                '<div class="loading-text">Image unavailable</div>';
                        }
                    });
                }
            }

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
    {{-- Intro Section --}}
    <section class="blog-intro">
        <div class="container">
            <div class="blog-intro-content">
                <span class="journal-label">The Linkuss Journal</span>
                <h1 class="blog-title">Insights, Updates & Stories</h1>
                <p class="blog-description">Discover the latest trends, insights, and stories from our team of experts</p>
            </div>
        </div>
        <div class="blog-hero">
            <div class="blog-hero-image">
                <img src="{{ asset('assets/blog-intro-img.png') }}" alt="Blog Hero Image - The Future of Web Development"
                    width="1280" height="720" fetchpriority="high" loading="eager" decoding="async">
                <div class="image-overlay"></div>
                <div class="loading-indicator">
                    <div class="loading-text">Loading amazing content...</div>
                </div>
            </div>
            <div class="blog-hero-content">
                <div class="container">
                    <div class="featured-post">
                        <span class="post-category">Featured</span>
                        <h2 class="post-title">The Future of Web Development: Trends to Watch in 2024</h2>
                        <p class="post-excerpt">Explore the emerging technologies and methodologies that are shaping the
                            future of web development...</p>
                        <a href="/blog/our-company" class="read-more-btn">
                            Read More
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="arrow-icon">
                                <path
                                    d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </header>

    {{-- All Blogs Section --}}
    <section class="all-blogs">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Latest Articles</span>
                <h2 class="section-title">Explore Our Blog</h2>
                <p class="section-description">Discover insights, tutorials, and industry trends from our expert team</p>
            </div>

            {{-- <div class="blog-filters">
                <button class="filter-btn active" data-category="all">All</button>
                <button class="filter-btn" data-category="technology">Technology</button>
                <button class="filter-btn" data-category="development">Development</button>
                <button class="filter-btn" data-category="design">Design</button>
                <button class="filter-btn" data-category="business">Business</button>
            </div> --}}
            @if ($blogs->count() > 0)
                <div class="flex flex-wrap justify-center gap-10" id="blogs-container">
                    @foreach ($blogs->take(5) as $blog)
                        @if ($blog->slug != 'our-company')
                            <x-blog-card :image="url($blog->featured_image)" :category="$blog->category" :title="$blog->title" :excerpt="Str::limit(strip_tags($blog->content), 150)"
                                :date="$blog->created_at->format('F d, Y')" :link="'/blog/' . $blog->slug" />
                        @endif
                    @endforeach
                </div>

                @if (count($blogs) > 4)
                    <div class="load-more-container">
                        <button class="load-more-btn" id="load-more-btn">
                            <span>Load More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="arrow-icon">
                                <path
                                    d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                        </button>
                    </div>
                @endif
            @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const blogsContainer = document.getElementById('blogs-container');
                    const loadMoreBtn = document.getElementById('load-more-btn');
                    const allBlogs = @json($blogs);
                    const baseUrl = '{{ config('app.url') }}';
                    //  let baseUrl = '{{ config('app.url') }}'.replace(/\/$/, '');
                    let currentIndex = 5;
                    const blogsPerLoad = 4;

                    if (loadMoreBtn) {
                        loadMoreBtn.addEventListener('click', function() {
                            const endIndex = Math.min(currentIndex + blogsPerLoad, allBlogs.length);

                            for (let i = currentIndex; i < endIndex; i++) {
                                const blog = allBlogs[i];
                                //   let featuredImage = blog.featured_image.replace(/^\/storage/, '/storage/app/public/');
                                const blogCard = document.createElement('div');
                                blogCard.className = 'blog-container';
                                //   <img src="${featuredImage}" alt="${blog.title}" />

                                blogCard.innerHTML = `
                                  <div class="blog-category-tag">${ blog.category }</div>
                                    <div class="blog-image-wrapper">
                                        <img src="${baseUrl}${blog.featured_image}" alt="${blog.title}" />
                                        <div class="blog-overlay"></div>
                                    </div>
                                    <div class="blog-content">
                                        <h2>${blog.title}</h2>
                                        <a href="/blog/${blog.slug}" class="blog-card-read-more-btn">
                                            <span>Read More</span>
                                            <span class="arrow">→</span>
                                        </a>
                                    </div>
                                `;

                                // Add fade-in animation
                                blogCard.style.opacity = '0';
                                blogCard.style.transform = 'translateY(20px)';
                                blogsContainer.appendChild(blogCard);

                                // Trigger animation
                                requestAnimationFrame(() => {
                                    blogCard.style.transition =
                                        'opacity 0.5s ease-out, transform 0.5s ease-out';
                                    blogCard.style.opacity = '1';
                                    blogCard.style.transform = 'translateY(0)';
                                });
                            }

                            currentIndex = endIndex;
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
                            if (currentIndex >= allBlogs.length) {
                                loadMoreBtn.style.display = 'none';
                            }
                        });
                    }
                });
            </script>
        </div>
    </section>

@endsection
