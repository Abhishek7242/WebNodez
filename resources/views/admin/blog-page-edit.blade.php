@extends('admin/layouts/main')
@section('title', 'WebNodez - Admin Dashboard')
@section('home', 'active')
@section('main-section')

    <style>
        .blog-editor-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .blog-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            min-height: 200px;
            resize: vertical;
        }

        .image-preview {
            max-width: 300px;
            margin-top: 1rem;
            border-radius: 4px;
        }

        .btn-submit {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:hover {
            background-color: #2563eb;
        }

        .category-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 1rem;
        }

        .featured-checkbox {
            margin-right: 0.5rem;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>

    <div class="blog-editor-container">
        <h1 class="text-3xl font-bold mb-6">{{ isset($blog) ? 'Edit Blog Post' : 'Create New Blog Post' }}</h1>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form class="blog-form" method="POST"
            action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($blog))
                @method('PUT')
            @endif

            <div class="form-group">
                <label class="form-label" for="title">Blog Title</label>
                <input type="text" id="title" name="title"
                    class="form-input @error('title') border-red-500 @enderror"
                    value="{{ old('title', $blog->title ?? '') }}" required>
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="slug">URL Slug</label>
                <input type="text" id="slug" name="slug"
                    class="form-input @error('slug') border-red-500 @enderror" value="{{ old('slug', $blog->slug ?? '') }}"
                    required>
                @error('slug')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <select id="category" name="category" class="category-select @error('category') border-red-500 @enderror"
                    required>
                    <option value="">Select a category</option>
                    <option value="Web Development"
                        {{ old('category', $blog->category ?? '') == 'Web Development' ? 'selected' : '' }}>Web
                        Development</option>
                    <option value="UI/UX Design"
                        {{ old('category', $blog->category ?? '') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design
                    </option>
                    <option value="Mobile Development"
                        {{ old('category', $blog->category ?? '') == 'Mobile Development' ? 'selected' : '' }}>Mobile
                        Development</option>
                    <option value="E-commerce"
                        {{ old('category', $blog->category ?? '') == 'E-commerce' ? 'selected' : '' }}>E-commerce
                    </option>
                    <option value="Security" {{ old('category', $blog->category ?? '') == 'Security' ? 'selected' : '' }}>
                        Security</option>
                    <option value="Artificial Intelligence"
                        {{ old('category', $blog->category ?? '') == 'Artificial Intelligence' ? 'selected' : '' }}>
                        Artificial Intelligence</option>
                </select>
                @error('category')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="featured_image">Featured Image</label>
                <input type="file" id="featured_image" name="featured_image"
                    class="form-input @error('featured_image') border-red-500 @enderror" accept="image/*">
                @error('featured_image')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                @if (isset($blog) && $blog->featured_image)
                    <img src="{{ $blog->featured_image }}" alt="Current featured image" class="image-preview mt-2">
                @endif
                <img id="imagePreview" class="image-preview hidden mt-2" src="" alt="Preview">
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content</label>
                <textarea id="content" name="content" class="form-input form-textarea @error('content') border-red-500 @enderror"
                    required>{{ old('content', $blog->content ?? '') }}</textarea>
                @error('content')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <input type="checkbox" name="is_featured" class="featured-checkbox"
                        {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }}>
                    Feature this post on homepage
                </label>
            </div>

            <button type="submit" class="btn-submit">{{ isset($blog) ? 'Update Blog Post' : 'Save Blog Post' }}</button>
        </form>
    </div>

    <script src="https://cdn.tiny.cloud/1/aeycodu5j1avic4jomsqz31ekkukgwyq3bugypde1er7241a/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            plugins: 'image code table lists link',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | image | table | code',
            height: 500,
            images_upload_url: '/admin/upload-image',
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/admin/upload-image');
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
            setup: function(editor) {
                editor.on('init', function() {
                    // Fix existing image paths when editor loads
                    var content = editor.getContent();
                    content = content.replace(/\.\.\/\.\.\/storage\//g, '/storage/');
                    editor.setContent(content);
                });
            }
        });

        // Image preview functionality
        document.getElementById('featured_image').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            var title = this.value;
            var slug = title
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>

@endsection
