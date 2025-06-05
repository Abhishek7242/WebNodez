@extends('admin/layouts/main')
@section('title', 'WebNodez - Manage Blogs')
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
    <div id="canvas-background" class="canvas-background"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>

    <style>
        .blog-list-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1rem;
            opacity: 0.9;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .blog-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .blog-image-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .blog-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-image {
            transform: scale(1.05);
        }

        .blog-content {
            padding: 1.5rem;
            position: relative;
        }

        .blog-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .blog-category {
            background-color: #f3f4f6;
            color: #4b5563;
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .blog-category:hover {
            background-color: #e5e7eb;
        }

        .status-badge {
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
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
            padding: 0.35rem 0.85rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .blog-date {
            color: #6b7280;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .blog-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }

        .create-blog-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        .create-blog-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(16, 185, 129, 0.3);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #9ca3af;
            margin-bottom: 1rem;
        }

        .empty-state-text {
            color: #6b7280;
            margin-bottom: 1.5rem;
        }

        .btn-view {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(220, 38, 38, 0.2);
        }

        /* Delete Confirmation Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.75rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .modal-text {
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #4b5563;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        .btn-confirm-delete {
            background: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-confirm-delete:hover {
            background: #b91c1c;
        }
    </style>

    <div class="blog-list-container">
        <div class="page-header">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="page-title">Manage Blogs</h1>
                    <p class="page-subtitle">Create, edit, and manage your blog posts</p>
                </div>
                <a href="{{ route('admin.blog.create') }}" class="create-blog-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create New Blog
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-value">{{ $blogs->count() }}</div>
                <div class="stat-label">Total Blogs</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $blogs->where('is_featured', true)->count() }}</div>
                <div class="stat-label">Featured Posts</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $blogs->where('status', 'published')->count() }}</div>
                <div class="stat-label">Published Posts</div>
            </div>
        </div>

        @if ($blogs->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No Blogs Yet</h3>
                <p class="empty-state-text">Start creating your first blog post to share your thoughts with the world.</p>
                <a href="{{ route('admin.blog.create') }}" class="create-blog-btn inline-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Create Your First Blog
                </a>
            </div>
        @else
            <div class="blog-grid">
                @foreach ($blogs as $blog)
                    <div class="blog-card">
                        <div class="blog-image-container">
                            @if ($blog->featured_image)
                                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="blog-image">
                            @else
                                <div class="blog-image bg-gray-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="blog-content">
                            <h2 class="blog-title">{{ $blog->title }}</h2>
                            <div class="blog-meta">
                                <span class="blog-category">{{ $blog->category }}</span>
                                <span class="status-badge status-{{ $blog->status }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ ucfirst($blog->status) }}
                                </span>
                                @if ($blog->is_featured)
                                    <span class="featured-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured
                                    </span>
                                @endif
                            </div>
                            <div class="blog-date">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $blog->created_at->format('M d, Y') }}
                            </div>
                            <div class="blog-actions">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit 
                                    </a>
                                    <a href="/admin/blog/view/{{ $blog->id }}" class="btn-view">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        View 
                                    </a>
                                    <button onclick="confirmDelete({{ $blog->id }}, '{{ $blog->title }}')"
                                        class="btn-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title">Delete Blog Post</h3>
            <p class="modal-text">Are you sure you want to delete "<span id="blogTitle"></span>"? This action cannot be
                undone.</p>
            <div class="modal-actions">
                <button onclick="closeModal()" class="btn-cancel">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm-delete">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, title) {
            const modal = document.getElementById('deleteModal');
            const blogTitle = document.getElementById('blogTitle');
            const deleteForm = document.getElementById('deleteForm');

            blogTitle.textContent = title;
            deleteForm.action = `/admin/blog/delete/${id}`;
            modal.style.display = 'flex';
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

@endsection
