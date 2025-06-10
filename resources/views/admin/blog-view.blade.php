@extends('admin/layouts/main')
@section('title', $blog->title . ' - WebNodez')
@section('home', 'active')
@section('main-section')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Blog Intro Section */
        .blog-intro-section {
            padding: 0 200px;
            position: relative;
            overflow: hidden;
        }

        .blog-heading-image {
            border-radius: 20px;
            overflow: hidden;
            margin-top: 3rem;
        }

        .blog-heading-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Blog Content Section */
        .blog-content-section {
            padding: 0 200px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        /* Blog Meta */
        .blog-meta {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
            font-size: 0.875rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .blog-date {
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .blog-category {
            background-color: #f3f4f6;
            color: #4b5563;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .blog-category:hover {
            background-color: #e5e7eb;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #4b5563;
            font-size: 0.875rem;
        }

        .author-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 9999px;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-weight: 600;
        }

        /* Blog Content */
        .blog-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #374151;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .blog-text p {
            margin-bottom: 1.5rem;
        }

        .blog-text h1,
        .blog-text h2,
        .blog-text h3,
        .blog-text h4,
        .blog-text h5,
        .blog-text h6 {
            color: #1f2937;
            margin: 2rem 0 1rem;
            line-height: 1.3;
        }

        .blog-text h1 {
            font-size: 2.5rem;
            font-weight: 800;
        }

        .blog-text h2 {
            font-size: 2rem;
            font-weight: 700;
        }

        .blog-text h3 {
            font-size: 1.75rem;
            font-weight: 600;
        }

        .blog-text h4 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .blog-text h5 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .blog-text h6 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .blog-text img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 2rem 0;
        }

        .blog-text blockquote {
            border-left: 4px solid #3b82f6;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            background-color: #f8fafc;
            border-radius: 0.5rem;
            font-style: italic;
            color: #4b5563;
        }

        /* List Styling */
        .blog-text ul,
        .blog-text ol {
            margin: 1.5rem 0;
            padding-left: 2.5rem;
        }

        .blog-text ul li,
        .blog-text ol li {
            margin-bottom: 0.75rem;
            display: list-item;
        }

        .blog-text ul li {
            list-style-type: disc;
        }

        .blog-text ol li {
            list-style-type: decimal;
        }

        /* Nested Lists */
        .blog-text ul ul li {
            list-style-type: circle;
        }

        .blog-text ol ol li {
            list-style-type: lower-alpha;
        }

        .blog-text ul ol li {
            list-style-type: decimal;
        }

        .blog-text ol ul li {
            list-style-type: disc;
        }

        .blog-text a {
            color: #3b82f6;
            text-decoration: underline;
            transition: color 0.2s ease;
        }

        .blog-text a:hover {
            color: #2563eb;
        }

        .blog-text table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
        }

        .blog-text table th,
        .blog-text table td {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
        }

        .blog-text table th {
            background-color: #f3f4f6;
            font-weight: 600;
        }

        .blog-text pre {
            background-color: #f3f4f6;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin: 1.5rem 0;
        }

        .blog-text code {
            font-family: monospace;
            background-color: #f3f4f6;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
        }

        /* Blog Actions */
        .blog-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 200px;
            border-top: 1px solid #e5e7eb;
            margin-top: 3rem;
        }

        .btn-back {
            background: #f3f4f6;
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: #e5e7eb;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        /* Status and Featured Badges */
        .status-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-published {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-archived {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .featured-badge {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Responsive Styles */
        @media (max-width: 1200px) {

            .blog-intro-section,
            .blog-content-section,
            .blog-actions {
                padding: 0 100px;
            }

            .blog-text {
                font-size: 1.1rem;
            }

            .blog-text h1 {
                font-size: 2.25rem;
            }

            .blog-text h2 {
                font-size: 1.875rem;
            }

            .blog-text h3 {
                font-size: 1.625rem;
            }
        }

        @media (max-width: 768px) {

            .blog-intro-section,
            .blog-content-section,
            .blog-actions {
                padding: 0 50px;
            }

            .blog-text {
                font-size: 1rem;
                line-height: 1.7;
            }

            .blog-text h1 {
                font-size: 2rem;
            }

            .blog-text h2 {
                font-size: 1.75rem;
            }

            .blog-text h3 {
                font-size: 1.5rem;
            }

            .blog-text h4 {
                font-size: 1.35rem;
            }

            .blog-text h5 {
                font-size: 1.2rem;
            }

            .blog-text h6 {
                font-size: 1.1rem;
            }

            .blog-meta {
                font-size: 0.8125rem;
                gap: 0.75rem;
            }

            .blog-category {
                padding: 0.4rem 1rem;
            }

            .author-avatar {
                width: 2.25rem;
                height: 2.25rem;
            }

            .featured-badge {
                padding: 0.4rem 1rem;
                font-size: 0.8125rem;
            }

            .blog-text blockquote {
                padding: 0.875rem 1.25rem;
                margin: 1.5rem 0;
            }

            .blog-text ul,
            .blog-text ol {
                padding-left: 2rem;
            }

            .btn-back,
            .btn-edit {
                padding: 0.6rem 1.25rem;
                font-size: 0.875rem;
            }
        }

        @media (max-width: 640px) {

            .blog-intro-section,
            .blog-content-section,
            .blog-actions {
                padding: 0 20px;
            }

            .blog-text {
                font-size: 0.95rem;
                line-height: 1.6;
            }

            .blog-text h1 {
                font-size: 1.75rem;
            }

            .blog-text h2 {
                font-size: 1.5rem;
            }

            .blog-text h3 {
                font-size: 1.35rem;
            }

            .blog-text h4 {
                font-size: 1.25rem;
            }

            .blog-text h5 {
                font-size: 1.15rem;
            }

            .blog-text h6 {
                font-size: 1rem;
            }

            .blog-meta {
                font-size: 0.75rem;
                gap: 0.5rem;
            }

            .blog-category {
                padding: 0.35rem 0.875rem;
            }

            .author-avatar {
                width: 2rem;
                height: 2rem;
            }

            .featured-badge {
                padding: 0.35rem 0.875rem;
                font-size: 0.75rem;
            }

            .blog-text blockquote {
                padding: 0.75rem 1rem;
                margin: 1.25rem 0;
            }

            .blog-text ul,
            .blog-text ol {
                padding-left: 1.75rem;
            }

            .blog-text table th,
            .blog-text table td {
                padding: 0.5rem;
                font-size: 0.875rem;
            }

            .blog-text pre {
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .blog-text code {
                font-size: 0.875rem;
            }

            .btn-back,
            .btn-edit {
                padding: 0.5rem 1rem;
                font-size: 0.8125rem;
            }

            .blog-actions {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
        }

        /* Blog Editor Content Styles */
        .blog-text [style*="text-align: center"] {
            text-align: center !important;
        }

        .blog-text [style*="font-family"] {
            font-family: inherit;
        }

        .blog-text [style*="font-size"] {
            font-size: inherit !important;
        }

        .blog-text h2[style*="text-align: center"] {
            text-align: center !important;
            margin: 2rem auto;
        }

        .blog-text h2[style*="text-align: center"] span {
            font-family: 'Arial Black', sans-serif;
            font-size: 2.5rem !important;
            line-height: 1.2;
            display: inline-block;
        }

        .blog-text p[style*="text-align: center"] {
            text-align: center !important;
            margin: 1rem auto;
        }

        .blog-text p[style*="text-align: center"] span {
            font-size: 1.5rem !important;
            line-height: 1.4;
            display: inline-block;
        }

        /* Responsive Styles for Editor Content */
        @media (max-width: 1200px) {
            .blog-text h2[style*="text-align: center"] span {
                font-size: 2.25rem !important;
            }

            .blog-text p[style*="text-align: center"] span {
                font-size: 1.35rem !important;
            }
        }

        @media (max-width: 768px) {
            .blog-text h2[style*="text-align: center"] span {
                font-size: 2rem !important;
            }

            .blog-text p[style*="text-align: center"] span {
                font-size: 1.25rem !important;
            }

            /* Override inline styles for mobile */
            .blog-text [style*="font-size: 36pt"],
            .blog-text [style*="font-size:36pt"] {
                font-size: 2rem !important;
            }

            .blog-text [style*="font-size: 18pt"],
            .blog-text [style*="font-size:18pt"] {
                font-size: 1.25rem !important;
            }
        }

        @media (max-width: 640px) {
            .blog-text h2[style*="text-align: center"] span {
                font-size: 1.75rem !important;
            }

            .blog-text p[style*="text-align: center"] span {
                font-size: 1.125rem !important;
            }

            /* Override inline styles for mobile */
            .blog-text [style*="font-size: 36pt"],
            .blog-text [style*="font-size:36pt"] {
                font-size: 1.75rem !important;
            }

            .blog-text [style*="font-size: 18pt"],
            .blog-text [style*="font-size:18pt"] {
                font-size: 1.125rem !important;
            }
        }
    </style>
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>
    <section class="blog-intro-section">
        <div class="container mx-auto px-4 py-16">
            <p class="text-2xl md:text-2xl font-bold text-center text-black mb-4">Blog Post</p>
            <p class="text-gray-600 text-center max-w-2xl mx-auto">Discover the latest insights, trends, and updates from
                our
                team of experts.</p>
        </div>
        <h1 class="text-4xl md:text-4xl text-center font-bold">{{ $blog->title }}</h1>
        <div class="blog-meta">
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
            @if ($blog->is_featured)
                <span class="featured-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    Featured
                </span>
            @endif
            <span class="status-badge status-{{ $blog->status }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ ucfirst($blog->status) }}
            </span>
        </div>
        @if ($blog->featured_image)
            <div class="blog-heading-image">
                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}">
            </div>
        @endif
    </section>

    <section class="blog-content-section">
        <div class="blog-text" id="blogContent">
            {!! $blog->content !!}
        </div>
    </section>

    <div class="blog-actions">
        <a href="/admin/manage-blogs" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Back to Blogs
        </a>
        <a href="/admin/blog/edit/{{ $blog->id }}" class="btn-edit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            Edit Blog
        </a>
    </div>

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
