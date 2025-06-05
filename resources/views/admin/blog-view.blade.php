@extends('admin/layouts/main')
@section('title', $blog->title . ' - WebNodez')
@section('home', 'active')
@section('main-section')

    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/canvas-background.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/intro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="{{ asset('js/canvas-background.js') }}"></script>

    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <style>
        .blog-view-container {
            padding: 2rem;
        }

        .blog-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .blog-title {
            font-size: 3rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
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

        .blog-date {
            color: #6b7280;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        .blog-content {
            background: white;
            padding: 0;
            margin-bottom: 3rem;
        }

        .blog-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            border-radius: 1rem;
            margin-bottom: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Preserve TinyMCE Content Styles */
        .blog-text {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #374151;
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

        /* Override list-style-type: none */
        .blog-text li[style*="list-style-type: none"] {
            list-style-type: none !important;
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

        .blog-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
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
    </style>

    <div class="blog-view-container">
        <div class="blog-header">
            <h1 class="blog-title">{{ $blog->title }}</h1>
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
        </div>

        <div class="blog-content">
            @if ($blog->featured_image)
                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="blog-image">
            @endif
            <div class="blog-text" id="blogContent">
                {!! $blog->content !!}
            </div>
        </div>

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
                        // Remove any ../../storage prefix
                        src = src.replace(/^\.\.\/\.\.\/storage\//, '');
                        // Add the correct storage URL
                        img.setAttribute('src', '/storage/' + src);
                    }
                });
            }
        });
    </script>

@endsection
