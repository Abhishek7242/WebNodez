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

        /* Rich Text Editor Styles */
        .tox-tinymce {
            border-radius: 4px !important;
            border-color: #d1d5db !important;
            min-height: 200vh !important;
        }

        .tox .tox-edit-area__iframe {
            background-color: white !important;
        }

        .tox .tox-edit-area {
            border: 1px solid #d1d5db !important;
            border-radius: 0 0 4px 4px !important;
        }

        .tox .tox-toolbar {
            background-color: #f3f4f6 !important;
            border-bottom: 1px solid #d1d5db !important;
        }

        .tox .tox-toolbar__group {
            border-color: #d1d5db !important;
        }

        .tox .tox-tbtn {
            color: #374151 !important;
        }

        .tox .tox-tbtn:hover {
            background-color: #e5e7eb !important;
        }

        .tox .tox-tbtn--enabled {
            background-color: #e5e7eb !important;
        }
    </style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/aeycodu5j1avic4jomsqz31ekkukgwyq3bugypde1er7241a/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
        <h1 class="text-3xl font-bold mb-6">Create New Blog Post</h1>

        <form class="blog-form" method="POST" action="/admin/blog/store" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Blog Title</label>
                <input type="text" id="title" name="title" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="slug">URL Slug</label>
                <input type="text" id="slug" name="slug" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="category">Category</label>
                <select id="category" name="category" class="category-select" required>
                    <option value="">Select a category</option>
                    <option value="About Company">About Company</option>
                    <option value="Web Development">Web Development</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Mobile Development">Mobile Development</option>
                    <option value="E-commerce">E-commerce</option>
                    <option value="Security">Security</option>
                    <option value="Artificial Intelligence">Artificial Intelligence</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="featured_image">Featured Image</label>
                <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*">
                <img id="imagePreview" class="image-preview hidden" src="" alt="Preview">
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content</label>
                <textarea id="content" name="content" class="form-input"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <input type="checkbox" name="is_featured" class="featured-checkbox">
                    Feature this post on homepage
                </label>
            </div>

            <button type="submit" class="btn-submit">Publish Blog Post</button>
        </form>
    </div>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: true,
            branding: false,
            promotion: false,
            resize: true,
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
                    padding: 1rem;
                }
                img {
                    max-width: 100%;
                    height: auto;
                }
                table {
                    max-width: 100%;
                    overflow-x: auto;
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
    </script>

@endsection
