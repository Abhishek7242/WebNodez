@extends('admin/layouts/main')
@section('title', 'WebNodez - Admin Dashboard')
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
    <div id="canvas-background" class="canvas-background h-100vh"></div>

    <script>
        const el = document.querySelector('#header');
        el.style.setProperty('--intro-bg', 'white');
        el.style.setProperty('--dark-bg', 'white');
    </script>
    <style>
        .container {
            min-height: 100vh;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-300">Manage OG Images</h1>
            <button onclick="openUploadModal()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Upload New Image</span>
            </button>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($images as $image)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 border hover:shadow-xl hover:-translate-y-1">
                    <div class="relative group">
                        <img src="{{ $image['path'] }}" alt="{{ $image['name'] }}" class="w-full h-48 object-cover">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            <div
                                class="flex space-x-3 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                                <button onclick="editImage('{{ $image['name'] }}')"
                                    class="bg-white hover:bg-blue-500 text-gray-800 hover:text-white p-3 rounded-full transition-all duration-300 transform hover:scale-110">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteImage('{{ $image['name'] }}')"
                                    class="bg-white hover:bg-red-500 text-gray-800 hover:text-white p-3 rounded-full transition-all duration-300 transform hover:scale-110">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $image['name'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $image['size'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Upload Modal -->
        <div id="uploadModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0"
                id="uploadModalContent">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Upload New Image</h3>
                    <button onclick="closeUploadModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="uploadForm" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Page</label>
                        <select name="page" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                            <option value="">Select a page</option>
                            <option value="home">Home Page</option>
                            <option value="about">About Page</option>
                            <option value="services">Services Page</option>
                            <option value="portfolio">Portfolio Page</option>
                            <option value="blog">Blog Page</option>
                            <option value="contact">Contact Page</option>
                            <option value="pricing">Pricing Page</option>
                            <option value="terms">Terms & Conditions</option>
                            <option value="privacy">Privacy Policy</option>
                            <option value="web-development">Web Development</option>
                            <option value="app-development">App Development</option>
                            <option value="e_commerse">E-Commerce</option>
                            <option value="ui-ux-design">UI/UX Design</option>


                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Image Type</label>
                        <select name="image_type" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                            <option value="">Select image type</option>
                            <option selected value="og-image">OG Image</option>
                            <option value="banner">Banner Image</option>
                            <option value="featured">Featured Image</option>
                            <option value="thumbnail">Thumbnail</option>
                            <option value="background">Background Image</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Choose Image</label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition-colors duration-300">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-500 hover:text-blue-600 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*"
                                            required onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <div class="relative rounded-lg overflow-hidden border border-gray-200">
                            <img id="preview" src="" alt="Preview" class="w-full h-48 object-contain">
                            <button type="button" onclick="removeImage()"
                                class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p id="imageInfo" class="mt-2 text-sm text-gray-600 text-center"></p>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeUploadModal()"
                            class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                            Upload Image
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal"
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0"
                id="editModalContent">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">Edit Image</h3>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <form id="editImageForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="current_filename" id="currentFilename">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Page</label>
                        <select name="page" id="editPageSelect" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                            <option value="">Select a page</option>
                            <option value="home">Home Page</option>
                            <option value="about">About Page</option>
                            <option value="services">Services Page</option>
                            <option value="portfolio">Portfolio Page</option>
                            <option value="blog">Blog Page</option>
                            <option value="contact">Contact Page</option>
                            <option value="pricing">Pricing Page</option>
                            <option value="terms">Terms & Conditions</option>
                            <option value="privacy">Privacy Policy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Image Type</label>
                        <select name="image_type" id="editImageTypeSelect" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-300">
                            <option value="">Select image type</option>
                            <option selected value="og-image">OG Image</option>
                            <option value="banner">Banner Image</option>
                            <option value="featured">Featured Image</option>
                            <option value="thumbnail">Thumbnail</option>
                            <option value="background">Background Image</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Alert Container -->
        <div id="alertContainer" class="fixed top-4 right-4 z-50"></div>

        <script>
            // Modal Animation Functions
            function showModal(modalId) {
                const modal = document.getElementById(modalId);
                const modalContent = document.getElementById(modalId + 'Content');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function hideModal(modalId) {
                const modal = document.getElementById(modalId);
                const modalContent = document.getElementById(modalId + 'Content');
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }

            function openUploadModal() {
                showModal('uploadModal');
            }

            function closeUploadModal() {
                hideModal('uploadModal');
            }

            function editImage(filename) {
                const modal = document.getElementById('editModal');
                const currentFilename = document.getElementById('currentFilename');
                const editPageSelect = document.getElementById('editPageSelect');
                const editImageTypeSelect = document.getElementById('editImageTypeSelect');

                const [page, imageType] = filename.replace('.jpg', '').split('-');

                currentFilename.value = filename;
                editPageSelect.value = page;
                editImageTypeSelect.value = imageType;

                showModal('editModal');
            }

            function closeEditModal() {
                hideModal('editModal');
            }

            // Alert Function
            function showAlert(message, type = 'success') {
                const alertContainer = document.getElementById('alertContainer');
                const alert = document.createElement('div');
                alert.className =
                    `mb-4 p-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
                alert.innerHTML = message;

                alertContainer.appendChild(alert);

                setTimeout(() => {
                    alert.classList.remove('translate-x-full');
                }, 10);

                setTimeout(() => {
                    alert.classList.add('translate-x-full');
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 3000);
            }

            // Form Submissions
            document.getElementById('uploadForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const page = formData.get('page');
                const imageType = formData.get('image_type');
                const image = formData.get('image');

                if (!image || !page || !imageType) {
                    showAlert('Please fill in all fields', 'error');
                    return;
                }

                try {
                    const response = await fetch('/admin/og-images/upload', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        showAlert(data.message);
                        closeUploadModal();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showAlert(data.message, 'error');
                    }
                } catch (error) {
                    showAlert('Failed to upload image. Please try again.', 'error');
                }
            });

            document.getElementById('editImageForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const currentFilename = formData.get('current_filename');
                const page = formData.get('page');
                const imageType = formData.get('image_type');
                const newFilename = `${page}-${imageType}.jpg`;

                try {
                    const response = await fetch(`/admin/og-images/${currentFilename}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            new_filename: newFilename
                        })
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        showAlert(data.message);
                        closeEditModal();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showAlert(data.message, 'error');
                    }
                } catch (error) {
                    showAlert('Failed to update image. Please try again.', 'error');
                }
            });

            async function deleteImage(filename) {
                if (!confirm('Are you sure you want to delete this image?')) {
                    return;
                }

                try {
                    const response = await fetch(`/admin/og-images/${filename}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.status === 'success') {
                        showAlert(data.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showAlert(data.message, 'error');
                    }
                } catch (error) {
                    showAlert('Failed to delete image. Please try again.', 'error');
                }
            }

            // Drag and Drop Functionality
            const dropZone = document.querySelector('.border-dashed');
            const fileInput = document.getElementById('image');

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
                const fileInput = document.getElementById('image');
                fileInput.files = files;
                previewImage(fileInput);
            }

            function previewImage(input) {
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');
                const imageInfo = document.getElementById('imageInfo');
                const file = input.files[0];

                if (file) {
                    // Show preview container
                    previewContainer.classList.remove('hidden');

                    // Create object URL for preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(file);

                    // Show image info
                    const size = (file.size / 1024).toFixed(2);
                    imageInfo.textContent = `File: ${file.name} (${size} KB)`;
                } else {
                    removeImage();
                }
            }

            function removeImage() {
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');
                const imageInfo = document.getElementById('imageInfo');
                const fileInput = document.getElementById('image');

                // Clear preview
                preview.src = '';
                imageInfo.textContent = '';
                previewContainer.classList.add('hidden');
                fileInput.value = '';
            }
        </script>
    @endsection
