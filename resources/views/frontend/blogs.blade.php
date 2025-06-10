@extends('frontend/layouts/main')
@section('title', 'WebNodez - Blogs')
@section('meta_description',
    'Explore WebNodez blog for the latest insights on web development, technology trends, and
    digital solutions. Read expert articles, tutorials, and industry updates from our team.')
@section('meta_keywords',
    'web development blog, technology insights, digital solutions blog, web design articles, IT
    trends, software development blog, tech tutorials, industry updates')
@section('og_image', asset('images/blogs-og.jpg'))
@section('blog', 'active')
@section('main-section')
    <link href="{{ asset('css/blogs.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>
    {{-- Intro Section --}}
    <section class="blog-intro">
        <div class="container">
            <div class="blog-intro-content">
                <span class="journal-label">The WebNodez Journal</span>
                <h1 class="blog-title">Insights, Updates & Stories</h1>
                <p class="blog-description">Discover the latest trends, insights, and stories from our team of experts</p>
            </div>
        </div>
        <div class="blog-hero">
            <div class="blog-hero-image">
                <img src="https://media.licdn.com/dms/image/v2/D4D12AQHqsDNHkRfi1A/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1690816353140?e=2147483647&v=beta&t=QEzfPwHWu9Rais39Xk3-FzanD-3InZ0voTzlvm48ZWw"
                    alt="Blog Hero Image">
                <div class="image-overlay"></div>
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
                    @if($blog->slug != 'our-company')
                        <x-blog-card :image="$blog->featured_image" :category="$blog->category" :title="$blog->title" :excerpt="Str::limit(strip_tags($blog->content), 150)"
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
                    let currentIndex = 5;
                    const blogsPerLoad = 4;

                    if (loadMoreBtn) {
                        loadMoreBtn.addEventListener('click', function() {
                            const endIndex = Math.min(currentIndex + blogsPerLoad, allBlogs.length);

                            for (let i = currentIndex; i < endIndex; i++) {
                                const blog = allBlogs[i];
                                const blogCard = document.createElement('div');
                                blogCard.className = 'blog-container';

                                // Create the blog card HTML structure matching the blog-card component
                                blogCard.innerHTML = `
                                  <div class="blog-category-tag">${ blog.category }</div>
                                    <div class="blog-image-wrapper">

                                        <img src="${blog.featured_image}" alt="${blog.title}" />
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
