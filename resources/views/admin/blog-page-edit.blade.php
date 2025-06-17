@extends('admin/layouts/main')
@section('title', 'WebNodez - Admin Dashboard')
@section('home', 'active')
@section('main-section')
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #f9fafb 100%);
            min-height: 100vh;
        }

        .blog-editor-container {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .blog-form-card {
            background: white;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.05);
        }

        .sticky-header {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 10;
            padding: 1.25rem 2rem;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .featured-checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f0f7ff;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .featured-checkbox-wrapper:hover {
            background: #e0f2fe;
        }

        .featured-checkbox {
            margin: 0;
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 2px solid #3b82f6;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .featured-checkbox:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .featured-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #1e40af;
            cursor: pointer;
        }

        .form-section {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            background: white;
            transition: all 0.3s ease;
        }

        .form-section:hover {
            background: #fafbff;
        }

        .form-section-title {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: #1e40af;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-section-title i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.95rem;
        }

        .form-input,
        .category-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 0.95rem;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .form-input:focus,
        .category-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .image-upload-container {
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: #fafbff;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .image-upload-container:hover {
            border-color: #3b82f6;
            background: #f0f7ff;
            transform: translateY(-2px);
        }

        .image-preview {
            max-width: 300px;
            margin-top: 1rem;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }

        .category-options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .category-option {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .category-option i {
            font-size: 1.25rem;
            color: #4b5563;
            transition: all 0.3s ease;
        }

        .category-option:hover {
            border-color: #3b82f6;
            background: #f0f7ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.1);
        }

        .category-option:hover i {
            color: #3b82f6;
            transform: scale(1.1);
        }

        .category-option.selected {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.15);
        }

        .category-option.selected i {
            color: #3b82f6;
        }

        .category-option::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #1f2937;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 4px;
            font-size: 0.8rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 111111;
        }

        .category-option::before {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 8px;
            height: 8px;
            background: #1f2937;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .category-option:hover::after,
        .category-option:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .editor-toolbar {
            display: none;
        }

        .blog-content-section {
            padding: 2rem;
            border: none;
            background: white;
        }

        .blog-content-section .form-group {
            margin: 0;
        }

        .blog-content-section .tox-tinymce {
            border: none !important;
            box-shadow: none !important;
        }

        .compact-inputs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .upload-icon {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .upload-text {
            font-size: 1.1rem;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .upload-subtext {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .upload-button {
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .upload-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/aeycodu5j1avic4jomsqz31ekkukgwyq3bugypde1er7241a/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    <div class="blog-editor-container">
        <form class="blog-form-card" method="POST"
            action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}"
            enctype="multipart/form-data">
            <div class="sticky-header">
                <h1
                    class="text-2xl font-bold mb-0 bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    {{ isset($blog) ? 'Edit Blog Post' : 'Create New Blog Post' }}</h1>
                <div class="header-actions">
                    <label class="featured-checkbox-wrapper">
                        <input type="checkbox" name="is_featured" class="featured-checkbox"
                            {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }}>
                        <span class="featured-label">Feature on Homepage</span>
                    </label>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane mr-2"></i>{{ isset($blog) ? 'Update' : 'Publish' }}
                    </button>
                </div>
            </div>
            @csrf
            @if (isset($blog))
                @method('PUT')
            @endif

            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-info-circle"></i>
                    <span>Basic Information</span>
                </div>
                <div class="compact-inputs">
                    <div class="form-group">
                        <label class="form-label" for="title">Blog Title</label>
                        <input type="text" id="title" name="title"
                            class="form-input @error('title') border-red-500 @enderror"
                            value="{{ old('title', $blog->title ?? '') }}" placeholder="Enter a catchy title" required>
                        @error('title')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="slug">URL Slug</label>
                        <input type="text" id="slug" name="slug"
                            class="form-input @error('slug') border-red-500 @enderror"
                            value="{{ old('slug', $blog->slug ?? '') }}" placeholder="your-blog-post-url" required>
                        @error('slug')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <div class="category-options">
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'About Company' ? 'selected' : '' }}"
                                data-value="About Company" data-tooltip="About Company">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'Web Development' ? 'selected' : '' }}"
                                data-value="Web Development" data-tooltip="Web Development">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'UI/UX Design' ? 'selected' : '' }}"
                                data-value="UI/UX Design" data-tooltip="UI/UX Design">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'Mobile Development' ? 'selected' : '' }}"
                                data-value="Mobile Development" data-tooltip="Mobile Development">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'E-commerce' ? 'selected' : '' }}"
                                data-value="E-commerce" data-tooltip="E-commerce">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'Security' ? 'selected' : '' }}"
                                data-value="Security" data-tooltip="Security">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="category-option {{ old('category', $blog->category ?? '') == 'Artificial Intelligence' ? 'selected' : '' }}"
                                data-value="Artificial Intelligence" data-tooltip="AI">
                                <i class="fas fa-robot"></i>
                            </div>
                        </div>
                        <input type="hidden" id="category" name="category"
                            value="{{ old('category', $blog->category ?? '') }}" required>
                        @error('category')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Featured Image Section -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-image"></i>
                    <span>Featured Image</span>
                </div>
                <div class="form-group">
                    <div class="image-upload-container" onclick="document.getElementById('featured_image').click()">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <p class="upload-text">Drag and drop your image here</p>
                        <p class="upload-subtext">or click to browse from your computer</p>
                        <button type="button" class="upload-button">
                            <i class="fas fa-image mr-2"></i>Choose Image
                        </button>
                        <input type="file" id="featured_image" name="featured_image" class="hidden" accept="image/*">
                    </div>
                    @if (isset($blog) && $blog->featured_image)
                        <img src="{{ asset($blog->featured_image) }}" alt="Current featured image"
                            class="image-preview mt-2">
                    @endif
                    <img id="imagePreview" class="image-preview hidden mt-2" src="" alt="Preview">
                    @error('featured_image')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Content Section -->
            <div class="form-section blog-content-section">
                <div class="form-group">
                    <textarea id="content" name="content" class="form-input @error('content') border-red-500 @enderror" required>{{ old('content', $blog->content ?? '') }}</textarea>
                    @error('content')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </div>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
            branding: false,
            promotion: false,
            resize: true,
            height: 600,
            images_upload_url: '/admin/upload-image',
            automatic_uploads: true,
            file_picker_types: 'image',
            images_reuse_filename: true,
            images_upload_handler: function(blobInfo, progress) {
                return new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('_token', '{{ csrf_token() }}');

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/admin/upload-image');

                    xhr.upload.onprogress = (e) => {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = function() {
                        if (xhr.status === 403) {
                            reject({
                                message: 'HTTP Error: ' + xhr.status,
                                remove: true
                            });
                            return;
                        }

                        if (xhr.status < 200 || xhr.status >= 300) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        const json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            reject('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        resolve(json.location);
                    };

                    xhr.onerror = function() {
                        reject('Image upload failed');
                    };

                    xhr.send(formData);
                });
            },
            content_style: `
                body {
                    font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    max-width: 100%;
                    overflow-x: hidden;
                    padding: 1.5rem;
                    color: #1f2937;
                }
                img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                }
                table {
                    max-width: 100%;
                    overflow-x: auto;
                    border-collapse: collapse;
                    margin: 1rem 0;
                }
                table td, table th {
                    border: 1px solid #e5e7eb;
                    padding: 0.75rem;
                }
                table th {
                    background: #f8fafc;
                    font-weight: 600;
                }
                blockquote {
                    border-left: 4px solid #3b82f6;
                    margin: 1rem 0;
                    padding: 0.5rem 1rem;
                    background: #f0f7ff;
                    border-radius: 0 8px 8px 0;
                }
                pre {
                    background: #1f2937;
                    color: #f3f4f6;
                    padding: 1rem;
                    border-radius: 8px;
                    overflow-x: auto;
                }
                code {
                    background: #f3f4f6;
                    padding: 0.2rem 0.4rem;
                    border-radius: 4px;
                    font-size: 0.9em;
                }
            `,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
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
        document.getElementById('title').addEventListener('input', function(e) {
            const title = e.target.value;
            const slug = title
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
            document.getElementById('slug').value = slug;
        });

        // Category selection
        document.querySelectorAll('.category-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.category-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
                document.getElementById('category').value = this.dataset.value;
            });
        });

        // Drag and drop for image upload
        const dropZone = document.querySelector('.image-upload-container');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-blue-500', 'bg-blue-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            const input = document.getElementById('featured_image');
            input.files = files;

            const event = new Event('change');
            input.dispatchEvent(event);
        }
    </script>

@endsection
